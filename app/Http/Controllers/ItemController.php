<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function insert(StoreItemRequest $request)
    {
        $raw = $request->input('item');

        $mapping = $this->_mapping($raw);

        $task = new Task();
        $task->name = $mapping['taskName'];
        $task->save();

        $tags = explode(',', $mapping['tagString']);

        foreach ($tags as $tagName) {
            $tagName = trim($tagName);
            if (!empty($tagName)) {
                Tag::create([
                    'tag_name' => $tagName,
                    'task_id' => $task->id,
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Task berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('dashboard')->with('error', 'Task tidak ditemukan.');
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Task berhasil dihapus.');
    }

    // Private function
    private function _mapping($raw)
    {
        $parts = explode('|', $raw);
        $taskName = trim($parts[0]);
        $tagString = isset($parts[1]) ? trim($parts[1]) : '';

        return [
            'taskName' => $taskName,
            'tagString' => $tagString,
        ];
    }
}
