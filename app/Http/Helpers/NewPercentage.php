<?php

namespace App\Http\Helpers;

use App\Models\Lessons;

class NewPercentage
{
    public function percentage($modules)
    {
        foreach($modules as $module)
        {
            if($module->lessons_complete)
                {
                    $no_lessons = Lessons::where('module_id', $module->module_id)->count();
                    $completed_lessons = count($module->lessons_complete);
                    if($no_lessons > $completed_lessons)
                    {
                        $new_pct = ($completed_lessons / $no_lessons) * 100;
                        $module->completed = round($new_pct);
                        $module->save();
                    }
                }
        }

        return;
    }
}
