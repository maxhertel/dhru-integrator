<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FerramentaResource\Pages;
use App\Filament\Resources\FerramentaResource\RelationManagers;
use App\Models\Ferramenta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FerramentaResource extends Resource
{
    protected static ?string $model = Ferramenta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
               Forms\Components\TextInput::make('nome')->required(),
                Forms\Components\Toggle::make('ativo')->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 Tables\Columns\TextColumn::make('nome')
                ->label('Nome')
                ->searchable()
                ->sortable(),
                
            Tables\Columns\IconColumn::make('ativo')
                ->label('Ativo')
                ->boolean()
                ->sortable(),
                
            Tables\Columns\TextColumn::make('created_at')
                ->label('Criado em')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                
            Tables\Columns\TextColumn::make('updated_at')
                ->label('Atualizado em')
                ->dateTime('d/m/Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
            Tables\Filters\TernaryFilter::make('ativo')
                ->label('Status')
                ->placeholder('Todos')
                ->trueLabel('Ativos')
                ->falseLabel('Inativos'),
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
            'index' => Pages\ListFerramentas::route('/'),
            'create' => Pages\CreateFerramenta::route('/create'),
            'edit' => Pages\EditFerramenta::route('/{record}/edit'),
        ];
    }
}
