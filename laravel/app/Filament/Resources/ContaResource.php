<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContaResource\Pages;
use App\Filament\Resources\ContaResource\RelationManagers;
use App\Models\Conta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ContaResource extends Resource
{
    protected static ?string $model = Conta::class;

    

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([  
                     Forms\Components\TextInput::make('nome')->required(),
                Forms\Components\Toggle::make('ativo')->default(true),
                Forms\Components\Select::make('status')
                    ->options([
                        'disponivel' => 'Disponível',
                        'alugado' => 'Alugado',
                        'desativado' => 'Desativado',
                    ])
                    ->default('disponivel')
                    ->required(),
                Forms\Components\DateTimePicker::make('ultima_atualizacao'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'success' => 'disponivel',
                    'danger'  => 'alugado',
                    'secondary' => 'desativado',
                ]),
            Tables\Columns\TextColumn::make('ferramenta.nome')->label('Ferramenta'),
            Tables\Columns\TextColumn::make('usuario'),
            Tables\Columns\TextColumn::make('ultima_atualizacao')->dateTime(),
                Tables\Columns\TextColumn::make('ferramenta')
                    ->searchable(),
                Tables\Columns\TextColumn::make('usuario')
                    ->searchable(),
                Tables\Columns\TextColumn::make('senha')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('ultima_atualizacao')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContas::route('/'),
            'create' => Pages\CreateConta::route('/create'),
            'edit' => Pages\EditConta::route('/{record}/edit'),
        ];
    }
}
