<?php

namespace App\Services;

use App\Models\Chunk;

class ChunkService
{
    public static function getAll()
    {
        return Chunk::query()
            ->active()
            ->orderBy('order')
            ->get();
    }

    public static function getAllByPosition(string $position)
    {
        return Chunk::query()
            ->active()
            ->where('position', $position)
            ->orderBy('order')
            ->get();
    }

    public static function positionChunks(string $position = '')
    {
        return Chunk::query()->where('position', $position)->active()->get();
    }

    public static function idChunk(string $id = '')
    {
        return Chunk::query()->where('id', $id)->active()->first();
    }
}
