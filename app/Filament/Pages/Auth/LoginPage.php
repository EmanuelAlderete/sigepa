<?php

namespace App\Filament\Pages\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Http\Responses\Auth\LoginResponse;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Validation\ValidationException;
use Filament\Pages\Auth\Login as BaseLoginPage;

class LoginPage extends BaseLoginPage
{
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        if (!Filament::auth()->attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = Filament::auth()->user();

        if (
            ($user instanceof FilamentUser) &&
            (!$user->canAccessPanel(Filament::getCurrentPanel()))
        ) {
            Filament::auth()->logout();

            $this->throwFailureValidationException();
        }

        session()->regenerate();

        return app(LoginResponse::class);
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.idt' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getIdtFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ]);
    }

    protected function getIdtFormComponent(): Component
    {
        return TextInput::make('idt')
            ->label('Identidade Militar')
            ->required()
            ->mask('999.999.999-9')
            ->autofocus();
    }

    protected function getBirthFormComponent(): Component
    {
        return DatePicker::make('birth')
            ->label('Data de Nascimento')
            ->required();
    }

    protected function getPasswordFormComponent(): Component
    {
        return parent::getPasswordFormComponent();
    }
    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'idt' => $data['idt'],
            'password' => $data['password'],
        ];
    }
}
