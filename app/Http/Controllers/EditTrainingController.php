<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\TrainingModules;
use App\Models\Lessons;
use App\Models\TrainingCategory;

class EditTrainingController extends Controller
{
    public function splash()
    {
        return view('training-maint.splash');
    }

    public function trainingInvite()
    {
        return view('training-maint.invites');
    }

    public function newModule($categoryId)
    {

        return View("training-maint.new-module", compact(['categoryId']));
    }

    public function categories()
    {
        $categories = TrainingCategory::all();

        return view('training-maint.categories', compact('categories'));
    }

    public function createCategory(Request $request)
    {

        $file=$request->file('image');
        $fileName = time() . $file->getClientOriginalName();
        $path = $file->storeAs('public/images', $fileName);

        $data = ['title' => $request->title,
                'image' => $fileName,
                'desc' => $request->desc
    ];

        TrainingCategory::create($data);

        return redirect()->route('categories')->withSuccess('Success!!');

    }

    public function moduleShow($categoryId)
    {
        $modules = TrainingModules::where('category_id', $categoryId)->get();
        $category = TrainingCategory::find($categoryId);
        $title = $category->title;

        return view('training-maint.create', compact(['modules','categoryId','title']));
    }

    public function createLesson($module_id)
    {
        $module = TrainingModules::find($module_id);
        $categoryId = $module->category_id;

        return view('training-maint.create-lesson', compact(['module_id','categoryId']));
    }

    public function storeModule(Request $request)
    {

        $file = $request->file('moduleImage');
        $fileImage = time() . $file->getClientOriginalName();
        $path = $file->storeAs('public/images', $fileImage);

        //echo json_encode(['location' => $path]);
        $data = ['title' => $request->title,
                'desc' => $request->desc,
                'image' => $fileImage,
                'category_id' => $request->categoryId
            ];


        TrainingModules::create($data);


        return redirect()->route('createTraining', ['id' => $request->categoryId])->withSuccess('Success!!');
    }

    public function storeLesson(Request $request)
    {

        $module_id = $request->module_id;

        $fileName = Null;
        if($request->has('file'))
            {

                $file=$request->file('file');
                $fileName = time() . $file->getClientOriginalName();
                $path = $file->storeAs('public/documents', $fileName);
            }

        $last = Lessons::select('order')->where('module_id',$module_id)->orderBy('order','desc')->first();

        if(!$last)
        {
            $new_number = 1;
        }
        else
        {
            $new_number = $last->order + 1;
        }

        $data = ['title' => $request->title,
                 'body' => $request->doc_body,
                 'module_id' => $module_id,
                 'document' => $fileName,
                 'order' => $new_number
        ];

        if(Lessons::create($data))
        {
            return redirect()->back()->withSuccess('Success!!');
        }
        else
        {
            return redirect()->back()->withError('Oops there was a problem!!');
        }

    }
}
