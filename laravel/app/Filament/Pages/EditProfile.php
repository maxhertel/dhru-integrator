<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class EditProfile extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static string $view = 'filament.pages.edit-profile';
    protected static ?string $navigationLabel = 'Meu Perfil';

    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function mount()
    {
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome')
                    ->required(),

                Forms\Components\TextInput::make('email')
                    ->label('E-mail')
                    ->email()
                    ->required(),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->label('Nova senha')
                    ->nullable()
                    ->same('password_confirmation'),

                Forms\Components\TextInput::make('password_confirmation')
                    ->password()
                    ->label('Confirmar senha')
                    ->nullable(),
            ])
            ->statePath('data');
    }

    public function save()
    {
        $user = auth()->user();

        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user->name = $this->name;
        $user->email = $this->email;

        // Atualizar senha se foi preenchida
        if ($this->password) {
            if ($this->password !== $this->password_confirmation) {
                $this->notify('danger', 'As senhas não coincidem.');
                return;
            }

            $user->password = Hash::make($this->password);
        }

        $user->save();

        $this->notify('success', 'Perfil atualizado com sucesso.');
    }



    protected function getActions(): array
    {
        return [
            \Filament\Actions\Action::make('Salvar')
                ->submit('save'),
        ];
    }
}
