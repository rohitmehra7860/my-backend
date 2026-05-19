<?php

namespace App\Filament\Resources\ActivityLogs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ActivityLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('causer.name')
                    ->label('User'),
                TextEntry::make('description')
                    ->label('Action'),
                TextEntry::make('subject_type')
                    ->label('Model')
                    ->formatStateUsing(fn($state) => class_basename($state)),
                TextEntry::make('event')
                    ->label('Event')
                    ->badge()
                    ->color(fn($state) => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    }),
                TextEntry::make('attribute_changes')
                    ->label('Changes')
                    ->html()
                    ->formatStateUsing(function ($state) {
                        if (empty($state)) {
                            return '—';
                        }

                        // 1. Ensure we have an array from our collection/JSON data
                        $changes = is_string($state) ? json_decode($state, true) : (is_object($state) ? $state->toArray() : $state);

                        $output = [];

                        // 2. We want to show both Old and New side-by-side if they both exist
                        if (isset($changes['old']) || isset($changes['attributes'])) {
                            $oldData = $changes['old'] ?? [];
                            $newData = $changes['attributes'] ?? [];

                            // Collect all unique keys changed across old and new data
                            $allKeys = array_unique(array_merge(array_keys($oldData), array_keys($newData)));

                            foreach ($allKeys as $key) {
                                $label = ucfirst(str_replace('_', ' ', $key)); // e.g., mime_type -> Mime type

                                // Helper function to extract readable strings even from nested relation arrays
                                $parseValue = function ($val) {
                                    if (is_array($val)) {
                                        // Check if it's Spatie's relation format: [{"name": "admin"}]
                                        if (isset($val[0]['name'])) {
                                            return implode(', ', array_column($val, 'name'));
                                        }
                                        // Fallback for simple arrays
                                        return implode(', ', $val);
                                    }
                                    return (string) $val;
                                };

                                $oldVal = isset($oldData[$key]) ? $parseValue($oldData[$key]) : null;
                                $newVal = isset($newData[$key]) ? $parseValue($newData[$key]) : null;

                                // Format the display output based on what data is present
                                if ($oldVal !== null && $newVal !== null && $oldVal !== $newVal) {
                                    $output[] = "<strong>{$label}</strong>: <span style='color: #ef4444; text-decoration: line-through;'>{$oldVal}</span> ➔ <span style='color: #22c55e;'>{$newVal}</span>";
                                } elseif ($newVal !== null) {
                                    $output[] = "<strong>{$label}</strong>: <span style='color: #22c55e;'>{$newVal}</span>";
                                } elseif ($oldVal !== null) {
                                    $output[] = "<strong>{$label}</strong>: <span style='color: #ef4444;'>Removed ({$oldVal})</span>";
                                }
                            }
                        } else {
                            // Fallback for flat logs with no 'old' or 'attributes' nesting
                            foreach ($changes as $key => $value) {
                                $label = ucfirst(str_replace('_', ' ', $key));
                                $valStr = is_array($value) ? json_encode($value) : $value;
                                $output[] = "<strong>{$label}</strong>: " . e($valStr);
                            }
                        }

                        return count($output) > 0 ? implode('<br>', $output) : '—';
                    }),
                TextEntry::make('created_at')
                    ->label('When')
                    ->dateTime(),
            ]);
    }
}
