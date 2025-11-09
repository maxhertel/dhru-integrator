<?php

namespace App\Filament\Resources\FerramentaResource\Pages;

use App\Filament\Resources\FerramentaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFerramenta extends EditRecord
{
    protected static string $resource = FerramentaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
