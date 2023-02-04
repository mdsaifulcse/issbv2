<?php

namespace App\Http\Controllers;

use App\ItemBank;
use App\PMQuestionBank;
use App\PMQuestionSet;
use App\QuestionSet;
use App\TestList;
use App\VerbalItemBank;
use App\VITQuestionBank;
use App\NumericQuestionBank;
use App\VITQuestionSet;
use App\NumericQuestionSet;
use App\ItemCategory;
use App\ItemLevel;
use App\CandidateType;
use App\ItemTag1;
use App\ItemTag2;
use App\ItemTag3;
use App\ItemTag4;
use App\ItemTag5;
use App\ItemTag6;
use App\ItemTag7;
use App\MemoryBank;
use App\TestConfiguration;
use App\TestGroups;
use App\BoardConfig;
use App\ItemStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Redirect;
use DB;
use App\Http\Requests;

class AdminController extends Controller
{
    public function createQuestion()
    {
        $item_levels = ItemLevel::select('id', 'name')->get();
        $item_categories = ItemCategory::select('id', 'name')->get();
        return view('create_iq_question', compact('item_levels', 'item_categories'));
    }
    public function itemCreate()
    {
        return view('item_create');
    }

    public function iqItemCreate()
    {
        return view('iq_item_create');
    }

    public function psymItemCreate()
    {
        return view('psym_item_create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'question_for' => 'required',
            'question_name' => 'required',
            'question_level' => 'required',
            'question_category' => 'required',
            'question_type' => 'required',
            'option_type' => 'required',
            'right_answer' => 'required',
            'publish_test' => 'required',

        ]);

        if ($request->question_type == 2) {
            $this->validate($request, [
                'img_questions' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
        } elseif ($request->question_type == 1) {
            $this->validate($request, [
                'text_questions' => 'required',
            ]);
        }

        if ($request->option_type == 1) {
            $this->validate($request, [
                "text_options"    => "required|array|min:1",
                "text_options.*"  => "required|min:1",
            ]);
        } elseif ($request->option_type == 2) {
            $this->validate($request, [
                'img_options' => 'required|array|min:1',
                'img_options.*' => 'required||min:1',

            ]);
        }

        if ($request->question_for == 'pm_question_bank') {
            $insert_question = new PMQuestionBank();
            $message = 'pm_success';
        } elseif ($request->question_for == 'vit_question_bank') {
            $insert_question = new VITQuestionBank();
            $message = 'vit_success';
        }

        $insert_question->name = $request->question_name;
        $insert_question->level = $request->question_level;
        $insert_question->category = $request->question_category;
        $insert_question->top_text = $request->top_text;
        $insert_question->down_text = $request->down_text;
        $insert_question->question_type = $request->question_type;

        if ($request->question_type == 1) {
            $insert_question->question = $request->text_questions;
        } elseif ($request->question_type == 2) {

            if ($request->hasFile('img_questions')) {
                $file = $request->file('img_questions');
                $original_name = $request->file('img_questions')->getClientOriginalName();
                $image = str_random(3) . '_' . $original_name;
                $destinationPath = public_path() . '/assets/uploads/questions/';
                $file->move($destinationPath, $image);
                $insert_question->question = $image;
            }
        }

        $insert_question->option_type = $request->option_type;

        if ($request->option_type == 1) {
            $txt_opt = $request->text_options;
            $text_options = implode("||", $txt_opt);

            $insert_question->options = $text_options;
        } elseif ($request->option_type == 2) {

            if ($request->hasFile('img_options')) {
                $files = $request->file('img_options');

                foreach ($files as $file) {
                    $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                    $destinationPath = public_path() . '/assets/uploads/options/';
                    $file->move($destinationPath, $file_name);

                    $img_options[] = $file_name;
                }
            }

            $imploded = implode('||', $img_options);
            $insert_question->options = $imploded;
        }

        $insert_question->correct_answer = $request->right_answer;
        $insert_question->publish_status = $request->publish_test;

        $insert_question->save();

        return ($message);
    }

    public function pmQuestionList($status)
    {
        $questions = PMQuestionBank::where('publish_status', $status)->paginate(10);

        return view('pm_question_list', compact('questions', 'status'));
    }

    public function vitQuestionList($status)
    {
        $questions = VITQuestionBank::where('publish_status', $status)->paginate(10);

        return view('vit_question_list', compact('questions', 'status'));
    }

    public function update($db, $id, $status)
    {
        $item_levels = ItemLevel::select('id', 'name')->get();
        $item_categories = ItemCategory::select('id', 'name')->get();

        if ($db == 'pm') {
            $question = PMQuestionBank::find($id);
        } elseif ($db == 'vit') {
            $question = VITQuestionBank::find($id);
        }
        return view('update_iq_question', compact('question', 'db', 'item_levels', 'item_categories', 'status'));
    }

    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'question_name' => 'required',
            'question_level' => 'required',
            'question_category' => 'required',
            'top_text' => 'required',
            'down_text' => 'required',
            'question_type' => 'required',
            'option_type' => 'required',
            'right_answer' => 'required',
            'publish_test' => 'required',

        ]);

        if ($request->question_type == 2) {
            $this->validate($request, [
                'img_questions' => 'image|mimes:jpeg,png,jpg,gif',
            ]);
        } elseif ($request->question_type == 1) {
            $this->validate($request, [
                'text_questions' => 'required',
            ]);
        }

        if ($request->option_type == 1) {
            $this->validate($request, [
                "text_options"    => "required|array|min:1",
                "text_options.*"  => "required|min:1",
            ]);
        } elseif ($request->option_type == 2) {
            $this->validate($request, [
                'img_options' => 'array|min:1',
                "text_options.*"  => "min:1",
            ]);
        }
        if ($request->db == 'pm') {
            $edit_question = PMQuestionBank::find($id);
            $message = 'pm_success';
        } elseif ($request->db == 'vit') {
            $edit_question = VITQuestionBank::find($id);
            $message = 'vit_success';
        }

        $edit_question->name = $request->question_name;
        $edit_question->level = $request->question_level;
        $edit_question->category = $request->question_category;
        $edit_question->top_text = $request->top_text;
        $edit_question->down_text = $request->down_text;
        $edit_question->question_type = $request->question_type;

        if ($request->question_type == 1) {
            $full_path = public_path() . '/assets/uploads/questions/' . $edit_question->question;
            if (file_exists($full_path)) {
                unlink($full_path);
            }

            $edit_question->question = $request->text_questions;
        } elseif ($request->question_type == 2) {

            if ($request->hasFile('img_questions')) {
                $full_path = public_path() . '/assets/uploads/questions/' . $edit_question->question;
                if (file_exists($full_path)) {
                    unlink($full_path);
                }

                $file = $request->file('img_questions');
                $original_name = $request->file('img_questions')->getClientOriginalName();
                $image = str_random(3) . '_' . $original_name;
                $destinationPath = public_path() . '/assets/uploads/questions/';
                $file->move($destinationPath, $image);
                $edit_question->question = $image;
            }
        }

        $edit_question->option_type = $request->option_type;

        if ($request->option_type == 1) {
            foreach (explode('||', $edit_question->options) as $options) {
                $full_path = public_path() . '/assets/uploads/options/' . $options;
                if (file_exists($full_path)) {
                    unlink($full_path);
                }
            }

            $txt_opt = $request->text_options;
            $text_options = implode("||", $txt_opt);

            $edit_question->options = $text_options;
        } elseif ($request->option_type == 2) {
            if ($request->hasFile('img_options')) {

                $files = $request->file('img_options');
                $array_filter = array_filter($files, 'strlen');

                $previous_options = explode('||', $edit_question->options);

                foreach ($array_filter as $file) {
                    $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                    $destinationPath = public_path() . '/assets/uploads/options/';
                    $file->move($destinationPath, $file_name);

                    $img_options[] = $file_name;

                    if ($request->preveous_option_type == 1) {
                        $array_merge = $img_options;
                    } else {
                        $array_merge = array_merge($previous_options, $img_options);
                    }

                    $options = implode('||', $array_merge);
                }

                $edit_question->options = $options;
            }
        }

        $edit_question->correct_answer = $request->right_answer;
        $edit_question->publish_status = $request->publish_test;

        $edit_question->save();

        return ($message);
    }

    public function delete($db, $id)
    {
        if ($db == 'pm') {
            $delete = PMQuestionBank::find($id);
        } elseif ($db == 'vit') {
            $delete = VITQuestionBank::find($id);
        }

        if ($delete->question_type == 2) {
            $full_path = public_path() . '/assets/uploads/questions/' . $delete->question;
            if (file_exists($full_path)) {
                unlink($full_path);
            }
        }
        if ($delete->option_type == 2) {
            foreach (explode('||', $delete->options) as $options) {
                $full_path = public_path() . '/assets/uploads/options/' . $options;
                if (file_exists($full_path)) {
                    unlink($full_path);
                }
            }
        }
        $delete->delete();

        return ('success');
    }

    public function singleOptionRemove(Request $request)
    {

        $id = $request->id;
        $db = $request->db;

        if ($db == 'pm') {
            $update = PMQuestionBank::find($id);
        } elseif ($db == 'vit') {
            $update = VITQuestionBank::find($id);
        }


        $previous_value = explode('||', $update->options);;

        $file_name[] = $request->file_name;

        $result = array_diff($previous_value, $file_name);

        $imploded = implode('||', $result);

        if (count($result)) {
            $full_path = public_path() . '/assets/uploads/options/' . $file_name[0];
            if (file_exists($full_path)) {
                unlink($full_path);
            }
            $update->options = $imploded;
            $update->save();
            return ('success');
        }
    }

    public function iqQuestionSetList($db)
    {
        if ($db == 'pm-set') {
            $question_set = PMQuestionSet::paginate(10);
        } elseif ($db == 'vit-set') {
            $question_set = VITQuestionSet::paginate(10);
        }
        $candidate_types = CandidateType::get();

        return view('iq_question_set_list', compact('db', 'question_set', 'candidate_types'));
    }

    public function createIQquestionSet()
    {
        $item_levels = ItemLevel::select('id', 'name')->get();
        /*$item_level_names=array_column($item_levels,'name');*/
        $counts = [];
        foreach ($item_levels as $level) {
            $count = PMQuestionBank::Where('level', $level->id)->count();
            if ($count != 0) {

                $counts = $this->array_push_assoc($counts, $level->name, $count);
            }
        }
        return view('create_iq_question_set');
    }

    public function array_push_assoc($array, $key, $value)
    {
        $array[$key] = $value;
        return $array;
    }

    public function getQusetionType($question_set_for)
    {
        if ($question_set_for == 'pm_question_set') {
            $easy = PMQuestionBank::where('level', '=', 'easy')->pluck("id");
            $medium = PMQuestionBank::where('level', '=', 'medium')->pluck("id");
            $hard = PMQuestionBank::where('level', '=', 'hard')->pluck("id");
        } elseif ($question_set_for == 'vit_question_set') {
            $easy = VITQuestionBank::where('level', '=', 'easy')->pluck("id");
            $medium = VITQuestionBank::where('level', '=', 'medium')->pluck("id");
            $hard = VITQuestionBank::where('level', '=', 'hard')->pluck("id");
        }

        return (compact('easy', 'medium', 'hard'));
    }

    public function storeIQquestionSet(Request $request)
    {
        $this->validate($request, [
            'total_time' => 'required',
            'candidate_type' => 'required',
            'pass_mark' => 'required',
        ]);

        $item_levels = ItemLevel::select('id', 'name')->get();
        $counts = [];
        foreach ($item_levels as $key => $level) {
            if ($request->question_set_for == 'pm_question_set') {
                $count = PMQuestionBank::Where('level', $level->id)->count();
            } elseif ($request->question_set_for == 'vit_question_set') {
                $count = VITQuestionBank::Where('level', $level->id)->count();
            }
            if ($count != 0) {
                $counts = $this->array_push_assoc($counts, $level->name, $count);
            }
            if (isset($counts[$level->name])) {
                $value =  $level->name;
                $total_request =  $request->$value;
                $question_levels[] = $total_request;
                if ($request->question_set_for == 'pm_question_set') {
                    $questions[] = PMQuestionBank::select('id')->where('level', $level->id)->inRandomOrder()->limit($total_request)->pluck('id')->toArray();
                } elseif ($request->question_set_for == 'vit_question_set') {
                    $questions[] = VITQuestionBank::select('id')->where('level', $level->id)->inRandomOrder()->limit($total_request)->pluck('id')->toArray();
                }
            }
        }

        foreach ($questions as $value) {
            $question_numbers[] = implode('||', $value);
        }
        $all_question_numbers = implode('||', $question_numbers);
        $question_level = implode('||', $question_levels);

        if ($request->question_set_for == 'pm_question_set') {
            $insert = new PMQuestionSet();
            $message = 'pm_success';
        } elseif ($request->question_set_for == 'vit_question_set') {
            $insert = new VITQuestionSet();
            $message = 'vit_success';
        }

        $insert->number_of_questions = $request->total_item;
        $insert->total_time = $request->total_time;
        $insert->question_numbers = $all_question_numbers;
        $insert->question_level = $question_level;
        $insert->item_set_name = $request->item_set_name;
        $insert->candidate_type = $request->candidate_type;
        $insert->pass_mark = $request->pass_mark;
        $insert->save();

        return ($message);
    }

    public function updateIQquestionSet($db, $id)
    {
        if ($db == 'pm-set') {
            $question_set = PMQuestionSet::find($id);

            $item_levels = ItemLevel::select('id', 'name')->get();
            $candidate_type = CandidateType::select('id', 'name')->get();

            $counts = [];
            foreach ($item_levels as $level) {
                $count = PMQuestionBank::Where('level', $level->id)->count();
                if ($count != 0) {

                    $counts = $this->array_push_assoc($counts, $level->name, $count);
                }
            }
        } elseif ($db == 'vit-set') {
            $question_set = VITQuestionSet::find($id);

            $item_levels = ItemLevel::select('id', 'name')->get();
            $candidate_type = CandidateType::select('id', 'name')->get();

            $counts = [];
            foreach ($item_levels as $level) {
                $count = VITQuestionBank::Where('level', $level->id)->count();
                if ($count != 0) {

                    $counts = $this->array_push_assoc($counts, $level->name, $count);
                }
            }
        }

        return view('update_iq_question_set', compact('db', 'question_set', 'counts', 'candidate_type'));
    }



    public function editIQquestionSet(Request $request, $id)
    {
        $this->validate($request, [
            'total_time' => 'required',
            'candidate_type' => 'required',
            'pass_mark' => 'required',
        ]);

        $item_levels = ItemLevel::select('id', 'name')->get();
        $counts = [];
        foreach ($item_levels as $key => $level) {
            if ($request->question_set_for == 'pm_question_set ') {
                $count = PMQuestionBank::Where('level', $level->id)->count();
            } elseif ($request->question_set_for == 'vit_question_set ') {
                $count = VITQuestionBank::Where('level', $level->id)->count();
            }
            if ($count != 0) {
                $counts = $this->array_push_assoc($counts, $level->name, $count);
            }
            if (isset($counts[$level->name])) {
                $value =  $level->name;
                $total_request =  $request->$value;
                $question_levels[] = $total_request;
                if ($request->question_set_for == 'pm_question_set ') {
                    $questions[] = PMQuestionBank::select('id')->where('level', $level->id)->inRandomOrder()->limit($total_request)->pluck('id')->toArray();
                } elseif ($request->question_set_for == 'vit_question_set ') {
                    $questions[] = VITQuestionBank::select('id')->where('level', $level->id)->inRandomOrder()->limit($total_request)->pluck('id')->toArray();
                }
            }
        }

        foreach ($questions as $value) {
            $question_numbers[] = implode('||', $value);
        }
        $all_question_numbers = implode('||', $question_numbers);
        $question_level = implode('||', $question_levels);

        if ($request->question_set_for == 'pm_question_set ') {
            $update = PMQuestionSet::find($id);
            $message = 'pm_success';
        } elseif ($request->question_set_for == 'vit_question_set ') {
            $update = VITQuestionSet::find($id);
            $message = 'vit_success';
        }

        $update->number_of_questions = $request->total_item;
        $update->total_time = $request->total_time;
        $update->question_numbers = $all_question_numbers;
        $update->question_level = $question_level;
        $update->item_set_name = $request->item_set_name;
        $update->candidate_type = $request->candidate_type;
        $update->pass_mark = $request->pass_mark;
        $update->save();

        return ($message);
    }

    public function deleteIQquestionSet($db, $id)
    {
        if ($db == 'pm-set') {
            $delete = PMQuestionSet::find($id);
        } elseif ($db == 'vit-set') {
            $delete = VITQuestionSet::find($id);
        }

        $delete->delete();

        return ('success');
    }

    public function singleQuestionView($db, $id)
    {
        if ($db == 'pm-set') {
            $question_list = PMQuestionBank::get();
            $question_set = PMQuestionSet::find($id);
            $set = 'PM';
        } elseif ($db == 'vit-set') {
            $question_list = VITQuestionBank::get();
            $question_set = VITQuestionSet::find($id);
            $set = 'VIT';
        }
        return view('single-question-view', compact('question_set', 'question_list', 'db', 'set'));
    }

    public function studentIQquestionSet()
    {
        $question_list = 20; //total question from pm_question_set table
        $number_of_question = 10; //total question for generate
        $total_students = 30; //total student

        function randomGen($min, $max, $quantity)
        {
            $numbers = range($min, $max);
            shuffle($numbers);
            return array_slice($numbers, 0, $quantity);
        }

        for ($i = 1; $i <= $total_students; $i++) {

            $numbers = randomGen(1, $question_list, $number_of_question);
            $question_numbers = implode('||', $numbers);

            echo 'Student ' . $i . ' = ' . $question_numbers . '<br>';
        }
    }


    public function createPMitemSet()
    {
        $item_levels = ItemLevel::select('id', 'name')->get();
        $candidate_type = CandidateType::select('id', 'name')->get();

        $counts = [];
        foreach ($item_levels as $level) {
            $count = PMQuestionBank::Where('level', $level->id)->count();
            if ($count != 0) {

                $counts = $this->array_push_assoc($counts, $level->name, $count);
            }
        }
        return view('create_pm_item_set', compact('counts', 'candidate_type'));
    }



    public function createVITitemSet()
    {
        $item_levels = ItemLevel::select('id', 'name')->get();
        $candidate_type = CandidateType::select('id', 'name')->get();

        $counts = [];
        foreach ($item_levels as $level) {
            $count = VITQuestionBank::Where('level', $level->id)->count();
            if ($count != 0) {

                $counts = $this->array_push_assoc($counts, $level->name, $count);
            }
        }
        return view('create_vit_item_set', compact('counts', 'candidate_type'));
    }

    public function NumericQuestion($status)
    {
        $numeric_questions = NumericQuestionBank::Where('publish_status', $status)->paginate(10);

        return view('numeric_question_bank', compact('numeric_questions', 'status'));
    }

    public function createNumericQuestion()
    {
        $categories = ItemCategory::get();
        $levels = ItemLevel::get();
        return view('create_numeric_question', compact('categories', 'levels'));
    }

    public function updateNumericQuestion($id, $status)
    {
        $numeric_question = NumericQuestionBank::find($id);
        $categories = ItemCategory::get();
        $levels = ItemLevel::get();
        return view('update_numeric_question', compact('numeric_question', 'categories', 'levels', 'status'));
    }

    public function storeNumericQuestion(Request $request)
    {
        $this->validate($request, [
            'question_name' => 'required',
            'question_level' => 'required',
            'question_category' => 'required',
            'img_questions' => 'image|mimes:jpeg,png,jpg,gif',
            'publish_test' => 'required',
        ]);

        $sub_question = implode('||', $request->sub_question);

        $text_options_explode = explode(',', $request->text_options_list);
        array_unshift($text_options_explode, "text_options_0");

        foreach ($text_options_explode as $key => $text_options) {
            $options[] = $request->$text_options;
            $option[] = implode('||', $options[$key]);
        }

        $option_value = implode('~~', $option);
        $sub_right_answers = implode('||', $request->sub_right_answer);

        $insert_question = new NumericQuestionBank();
        $insert_question->name = $request->question_name;
        $insert_question->level = $request->question_level;
        $insert_question->category = $request->question_category;
        $insert_question->top_text = $request->top_text;
        $insert_question->down_text = $request->down_text;
        $insert_question->question_type = $request->question_type;

        if ($request->hasFile('img_questions')) {
            $file = $request->file('img_questions');
            $original_name = $request->file('img_questions')->getClientOriginalName();
            $image = str_random(3) . '_' . $original_name;
            $destinationPath = public_path() . '/assets/uploads/questions/';
            $file->move($destinationPath, $image);
            $insert_question->question = $image;
        }

        $insert_question->sub_questions = $sub_question;
        $insert_question->sub_options = $option_value;
        $insert_question->sub_right_answers = $sub_right_answers;
        $insert_question->publish_status = $request->publish_test;
        $insert_question->save();

        return Redirect::to('/numeric-question-bank/' . $request->publish_test)->with('success', 'Numeric Item has been successfully created');
    }

    public function editNumericQuestion(Request $request, $id)
    {
        $this->validate($request, [
            'question_name' => 'required',
            'question_level' => 'required',
            'question_category' => 'required',
            'img_questions' => 'mimes:jpeg,png,jpg,gif',
            'publish_test' => 'required',
        ]);


        $sub_question = implode('||', $request->sub_question);

        $text_options_explode = explode(',', $request->text_options_list);

        foreach ($text_options_explode as $key => $text_options) {
            $options[] = $request->$text_options;
            $option[] = implode('||', $options[$key]);
        }

        $option_value = implode('~~', $option);

        $sub_right_answers = implode('||', $request->sub_right_answer);

        $update_question = NumericQuestionBank::find($id);
        $update_question->name = $request->question_name;
        $update_question->level = $request->question_level;
        $update_question->category = $request->question_category;
        $update_question->top_text = $request->top_text;
        $update_question->down_text = $request->down_text;
        $update_question->question_type = $request->question_type;

        if ($request->hasFile('img_questions')) {
            $full_path = public_path() . '/assets/uploads/questions/' . $update_question->question;
            if (file_exists($full_path)) {
                unlink($full_path);
            }

            $file = $request->file('img_questions');
            $original_name = $request->file('img_questions')->getClientOriginalName();
            $image = str_random(3) . '_' . $original_name;
            $destinationPath = public_path() . '/assets/uploads/questions/';
            $file->move($destinationPath, $image);
            $update_question->question = $image;
        }

        $update_question->sub_questions = $sub_question;
        $update_question->sub_options = $option_value;
        $update_question->sub_right_answers = $sub_right_answers;
        $update_question->publish_status = $request->publish_test;
        $update_question->save();

        return Redirect::to('/numeric-question-bank/' . $request->publish_test)->with('success', 'Numeric Item has been successfully updated');
    }

    public function deleteNumericQuestion($id)
    {
        $delete = NumericQuestionBank::find($id);
        $full_path = public_path() . '/assets/uploads/questions/' . $delete->question;
        if (file_exists($full_path)) {
            unlink($full_path);
        }

        $delete->delete();

        return ('success');
    }
    public function numericQuestionSet(Request $request)
    {
        $this->validate($request, [
            'candidate_type' => 'required',
            'item_set_name' => 'required',
            'item_numbers' => 'required',
            'total_time' => 'required',
        ]);

        if ($request->data[0] == 'all') {
            $numeric_all = NumericQuestionBank::get();
            foreach ($numeric_all as $value) {
                $data[] =  $value->id;
                $item_numbers = count($data);
            }
        } else {
            $data =  $request->data;
            $item_numbers = $request->item_numbers;
        }

        $values = [$data, $request->candidate_type, $request->item_set_name, $item_numbers, $request->total_time];

        dd($values);
    }


    // item category
    public function itemCategory()
    {
        $categories = ItemCategory::paginate(10);
        return view('item_category_list', compact('categories'));
    }

    public function createItemCategory()
    {
        return view('create_item_category');
    }

    public function storeItemCategory(Request $request)
    {
        $this->validate($request, [
            'category_name' => 'required',
        ]);

        $insert = new ItemCategory();
        $insert->name = $request->category_name;
        $insert->save();

        return ('success');
    }

    public function updateItemCategory($id)
    {
        $category = ItemCategory::find($id);
        return view('update_item_category', compact('category'));
    }

    public function editItemCategory(Request $request, $id)
    {
        $this->validate($request, [
            'category_name' => 'required',
        ]);

        $insert = ItemCategory::find($id);
        $insert->name = $request->category_name;
        $insert->save();

        return ('success');
    }

    public function destroyItemCategory($id)
    {
        ItemCategory::find($id)->delete();
        return ('success');
    }

    // item level
    public function itemLevel()
    {
        $levels = ItemLevel::paginate(10);
        return view('item_level_list', compact('levels'));
    }

    public function createItemLevel()
    {
        return view('create_item_level');
    }

    public function storeItemLevel(Request $request)
    {
        $this->validate($request, [
            'level_name' => 'required',
        ]);

        $insert = new ItemLevel();
        $insert->name = $request->level_name;
        $insert->save();

        return ('success');
    }

    public function updateItemLevel($id)
    {
        $level = ItemLevel::find($id);
        return view('update_item_level', compact('level'));
    }

    public function editItemLevel(Request $request, $id)
    {
        $this->validate($request, [
            'level_name' => 'required',
        ]);

        $insert = ItemLevel::find($id);
        $insert->name = $request->level_name;
        $insert->save();

        return ('success');
    }

    public function destroyItemLevel($id)
    {
        ItemLevel::find($id)->delete();
        return ('success');
    }

    // candidate type
    public function candidateType()
    {
        $candidate_types = CandidateType::paginate(10);
        return view('candidate_type_list', compact('candidate_types'));
    }

    public function createCandidateType()
    {
        return view('create_candidate_type');
    }

    public function storeCandidateType(Request $request)
    {
        $this->validate($request, [
            'candidate_type' => 'required',
        ]);

        $insert = new CandidateType();
        $insert->name = $request->candidate_type;
        $insert->save();

        return ('success');
    }

    public function updateCandidateType($id)
    {
        $candidate_type = CandidateType::find($id);
        return view('update_candidate_type', compact('candidate_type'));
    }

    public function editCandidateType(Request $request, $id)
    {
        $this->validate($request, [
            'candidate_type' => 'required',
        ]);

        $insert = CandidateType::find($id);
        $insert->name = $request->candidate_type;
        $insert->save();

        return ('success');
    }

    public function destroyCandidateType($id)
    {
        CandidateType::find($id)->delete();
        return ('success');
    }

    // test list

    public function testList()
    {
        $test_list = TestList::orderBy('id','DESC')->paginate(15);
        return view('test_list', compact('test_list'));
    }

    public function createTest()
    {
        return view('create_test');
    }

    public function storeTest(Request $request)
    {
        $this->validate($request, [
            'test_name' => 'required',
            'status' => 'required'
        ]);

        $insert = new TestList();
        $insert->name = $request->test_name;
        $insert->status = $request->status;
        $insert->save();

        return ('success');
    }

    public function editTest($id)
    {
        $test = TestList::find($id);
        return view('update_test', compact('test'));
    }

    public function updateTest(Request $request, $id)
    {
        $this->validate($request, [
            'test_name' => 'required',
            'status' => 'required'
        ]);

        $update = TestList::find($id);
        $update->name = $request->test_name;
        $update->status = $request->status;
        $update->save();

        return ('success');
    }

    public function viewNumericQuestion($id)
    {
        $numeric_question = NumericQuestionBank::find($id);
        return view('view_numeric_question', compact('numeric_question'));
    }

    public function createNumericQuestionSet()
    {
        $numeric_questions = DB::table('numeric_question_bank')->join('item_level', 'numeric_question_bank.level', '=', 'item_level.id')->select('numeric_question_bank.*', 'numeric_question_bank.name As item_name', 'item_level.name As item_level')->paginate(10);
        $candidate_type = CandidateType::get();

        return view('numeric_question_set', compact('numeric_questions', 'candidate_type'));
    }


    public function storeNumericQuestionSet(Request $request)
    {

        $this->validate($request, [
            'candidate_type' => 'required',
            'item_set_name' => 'required',
            'item_numbers' => 'required',
            'total_time' => 'required',
        ]);

        if ($request->data[0] == 'all') {
            $item_number = NumericQuestionBank::all()->pluck('id')->toArray();
            $total_items = NumericQuestionBank::all()->count();
            $numeric_all_levels = NumericQuestionBank::all()->pluck('level')->toArray();
            $levels = array_count_values($numeric_all_levels);
            $item_levels = [];
            foreach ($levels as $key => $level) {
                $singular_level = "$key" . '||' . $level;
                array_push($item_levels, $singular_level);
            }
        } else {
            $item_level = [];
            $item_number = [];
            foreach ($request->data as $values) {
                $exploding = explode('||', $values);

                array_push($item_level, $exploding[1]);
                array_push($item_number, $exploding[0]);
            }

            $levels = array_count_values($item_level);
            $item_levels = [];
            foreach ($levels as $key => $level) {
                $singular_level = "$key" . '||' . $level;
                array_push($item_levels, $singular_level);
            }
            $total_items = $request->item_numbers;
        }
        $imploded_items = implode('||', $item_number);
        $imploded_levels = implode('~~', $item_levels);
        $insert = new NumericQuestionSet();
        $insert->item_level = $imploded_levels;
        $insert->candidate_type = $request->candidate_type;
        $insert->item_set_name = $request->item_set_name;
        $insert->total_items = $total_items;
        $insert->total_time = $request->total_time;
        $insert->numeric_question_id = $imploded_items;
        $insert->save();

        return ('success');
    }

    public function itemBankActive()
    {
        $memory_bank = MemoryBank::where('item_status', 1)->count();
        $itemFor = ItemBank::where('item_status', 1)->select('item_for')->groupBy('item_for')->get()->toArray();

        $test_list = TestList::whereIn('id', $itemFor)->get();

        return view('item_bank_active', compact('test_list', 'memory_bank'));
    }

    public function itemNoAnswer()
    {
        $memory_bank    = MemoryBank::where('item_status', 4)->count();
        $itemFor        = ItemBank::where('item_status', 4)->select('item_for')->groupBy('item_for')->get()->toArray();

        $test_list      = TestList::whereIn('id', $itemFor)->get();

        return view('item_bank_no_answer', compact('test_list', 'memory_bank'));
    }



    public function itemBankTest()
    {
        $memory_bank = MemoryBank::where('item_status', 3)->count();
        $itemFor = ItemBank::where('item_status', 3)->select('item_for')->groupBy('item_for')->get()->toArray();

        $test_list = TestList::whereIn('id', $itemFor)->get();

        return view('item_bank_test', compact('test_list', 'memory_bank'));
    }

    public function itemBankInactive()
    {
        $memory_bank = MemoryBank::where('item_status', 2)->count();
        $itemFor = ItemBank::where('item_status', 2)->select('item_for')->groupBy('item_for')->get()->toArray();
        $test_list = TestList::whereIn('id', $itemFor)->get();
        return view('item_bank_inactive', compact('test_list', 'memory_bank'));
    }

    public function itemBankDemo()
    {
        $memory_bank = MemoryBank::where('item_status', 5)->count();
        $itemFor = ItemBank::where('item_status', 5)->select('item_for')->groupBy('item_for')->get()->toArray();
        $test_list = TestList::whereIn('id', $itemFor)->get();
        return view('item_bank_demo', compact('test_list', 'memory_bank'));
    }



    public function numericItemSetList()
    {
        $numeric_set = NumericQuestionSet::get();

        return view('numeric_set_list', compact('numeric_set'));
    }

    public function updateNumericItemSet($id)
    {
        $numeric_set = NumericQuestionSet::find($id);
        $numeric_questions = DB::table('numeric_question_bank')->join('item_level', 'numeric_question_bank.level', '=', 'item_level.id')->select('numeric_question_bank.*', 'numeric_question_bank.name As item_name', 'item_level.name As item_level')->paginate(10);
        $candidate_type = CandidateType::get();
        return view('update_numeric_set', compact('numeric_set', 'candidate_type', 'numeric_questions'));
    }

    public function editNumericQuestionSet(Request $request, $id)
    {
        $this->validate($request, [
            'candidate_type' => 'required',
            'item_set_name' => 'required',
            'item_numbers' => 'required',
            'total_time' => 'required',
        ]);

        if ($request->data[0] == 'all') {
            $item_number = NumericQuestionBank::all()->pluck('id')->toArray();
            $total_items = NumericQuestionBank::all()->count();
            $numeric_all_levels = NumericQuestionBank::all()->pluck('level')->toArray();
            $levels = array_count_values($numeric_all_levels);
            $item_levels = [];
            foreach ($levels as $key => $level) {
                $singular_level = "$key" . '||' . $level;
                array_push($item_levels, $singular_level);
            }
        } else {
            $item_levels = [];
            $item_number = $request->data;
            $total_items = count($item_number);
            foreach ($item_number as $all_levels) {
                $numeric_all_levels[] = NumericQuestionBank::where('id', $all_levels)->pluck('level')->first();
            }
            $levels = array_count_values($numeric_all_levels);
            foreach ($levels as $key => $level) {
                $singular_level = "$key" . '||' . $level;
                array_push($item_levels, $singular_level);
            }
        }

        $imploded_items = implode('||', $item_number);
        $imploded_levels = implode('~~', $item_levels);

        $insert = NumericQuestionSet::find($id);
        $insert->item_level = $imploded_levels;
        $insert->candidate_type = $request->candidate_type;
        $insert->item_set_name = $request->item_set_name;
        $insert->total_items = $total_items;
        $insert->total_time = $request->total_time;
        $insert->numeric_question_id = $imploded_items;
        $insert->save();

        return ('success');
    }

    public function destroyNumericQuestionSet($id)
    {
        NumericQuestionSet::find($id)->delete();
        return ('success');
    }

    // verbal item bank

    public function verbalItemBank($status)
    {
        $verbal_items = VerbalItemBank::where('publish_status', $status)->paginate(10);
        $item_levels = ItemLevel::get();
        return view('verbal_item_bank', compact('verbal_items', 'item_levels', 'status'));
    }

    public function createVerbalItem()
    {
        $levels = ItemLevel::get();
        $categories = ItemCategory::get();
        return view('create_verbal_item', compact('levels', 'categories'));
    }

    public function storeVerbalItem(Request $request)
    {
        $this->validate($request, [
            'question_name' => 'required',
            'question_level' => 'required',
            'question_category' => 'required',
            'publish_test' => 'required',
        ]);

        $sub_question = implode('||', $request->sub_question);

        $text_options_explode = explode(',', $request->text_options_list);
        array_unshift($text_options_explode, "text_options_0");

        foreach ($text_options_explode as $key => $text_options) {
            $options[] = $request->$text_options;
            $option[] = implode('||', $options[$key]);
        }

        $option_value = implode('~~', $option);
        $sub_right_answers = implode('||', $request->sub_right_answer);

        $insert_question = new VerbalItemBank();
        $insert_question->name = $request->question_name;
        $insert_question->level = $request->question_level;
        $insert_question->category = $request->question_category;
        $insert_question->top_text = $request->top_text;
        $insert_question->down_text = $request->down_text;
        $insert_question->question_type = $request->question_type;
        $insert_question->question = $request->item;
        $insert_question->sub_questions = $sub_question;
        $insert_question->sub_options = $option_value;
        $insert_question->sub_right_answers = $sub_right_answers;
        $insert_question->publish_status = $request->publish_test;

        $insert_question->save();

        return ('success');
    }

    public function editVerbalItem($id)
    {
        $verbal_item = VerbalItemBank::find($id);
        $levels = ItemLevel::get();
        $categories = ItemCategory::get();
        return view('update_verbal_item', compact('verbal_item', 'levels', 'categories'));
    }

    public function updateVerbalItem(Request $request, $id)
    {
        $this->validate($request, [
            'question_name' => 'required',
            'question_level' => 'required',
            'question_category' => 'required',
            'publish_test' => 'required',
        ]);

        $sub_question = implode('||', $request->sub_question);

        $text_options_explode = explode(',', $request->text_options_list);

        foreach ($text_options_explode as $key => $text_options) {
            $options[] = $request->$text_options;
            $option[] = implode('||', $options[$key]);
        }

        $option_value = implode('~~', $option);

        $sub_right_answers = implode('||', $request->sub_right_answer);

        $insert_question = VerbalItemBank::find($id);
        $insert_question->name = $request->question_name;
        $insert_question->level = $request->question_level;
        $insert_question->category = $request->question_category;
        $insert_question->top_text = $request->top_text;
        $insert_question->down_text = $request->down_text;
        $insert_question->question_type = $request->question_type;
        $insert_question->question = $request->item;
        $insert_question->sub_questions = $sub_question;
        $insert_question->sub_options = $option_value;
        $insert_question->sub_right_answers = $sub_right_answers;
        $insert_question->publish_status = $request->publish_test;

        $insert_question->save();

        return ('success');
    }

    public function destroyVerbalItem($id)
    {
        VerbalItemBank::find($id)->delete();
        return ('success');
    }

    // abstract item bank

    public function createAbstractItemBank()
    {
        $levels = ItemLevel::get();
        $categories = ItemCategory::get();
        return view('create_abstract_item', compact('levels', 'categories'));
    }

    public function itemList($item_for, $status)
    {
        $test_list = TestList::get();
        $items = ItemBank::where('item_for', $item_for)->where('item_status', $status)->latest()->paginate(10);

        return view('item_list', compact('items', 'test_list', 'item_for', 'status'));
    }

    public function itemPreview($id){
        $data['itemDetails'] = $itemDetails = ItemBank::find($id);
        $data['status'] = $itemDetails->item_status;
        return view('item_preview', $data);
    }

    // for new item
    public function createNewItem()
    {
        $item_levels        = ItemLevel::get();
        $item_categories    = ItemCategory::get();
        $item_tag1          = ItemTag1::get();
        $item_tag2          = ItemTag2::get();
        $item_tag3          = ItemTag3::get();
        $item_tag4          = ItemTag4::get();
        $item_tag5          = ItemTag5::get();
        $item_tag6          = ItemTag6::get();
        $item_tag7          = ItemTag7::get();
        $test_list          = TestList::get();
        $item_statuses      = ItemStatus::orderBy('sl_no', 'asc')->get();

        return view('create_new_item', compact('item_levels', 'item_categories', 'test_list','item_tag1','item_tag2','item_tag3','item_tag4','item_tag5','item_tag6','item_tag7', 'item_statuses'));
    }

    public function storeNewItem(Request $request)
    {
        $item_for = $request->item_for;
        $status = $request->publish_test;

        $insert_data = new ItemBank();
        $insert_data->name = $request->question_name;
        $insert_data->item_for = $request->item_for;
        $insert_data->level = $request->question_level;
        $insert_data->category = $request->question_category;
        $insert_data->tag1 = $request->question_tag1;
        $insert_data->tag2 = $request->question_tag2;
        $insert_data->tag3 = $request->question_tag3;
        $insert_data->tag4 = $request->question_tag4;
        $insert_data->tag5 = $request->question_tag5;
        $insert_data->tag6 = $request->question_tag6;
        $insert_data->tag7 = $request->question_tag7;
        $insert_data->top_text = $request->top_text;
        $insert_data->down_text = $request->down_text;
        $insert_data->item_type = $request->question_type;
        $insert_data->item_status = $request->publish_test;

        if ($request->question_type == 1) { //  For question type TEXT--------------
            $item = $request->item_text;
        } elseif ($request->question_type == 2) {
            if ($request->hasFile('item_img')) { //  For question type IMAGE--------------
                $file = $request->file('item_img');

                $file_name = rand(3,6) . '_' . $file->getClientOriginalName();
                $destinationPath = public_path() . '/assets/uploads/questions/images/';
                $file->move($destinationPath, $file_name);
                $item = $file_name;
            }
        } elseif ($request->question_type == 3) { //  For question type SOUND--------------
            if ($request->hasFile('item_sound')) {
                $file = $request->file('item_sound');

                $file_name = rand(3,6) . '_' . $file->getClientOriginalName();
                $destinationPath = public_path() . '/assets/uploads/questions/sounds/';
                $file->move($destinationPath, $file_name);
                $item = $file_name;
            }
        }
        $insert_data->item = $item;

        // ------------------------- Sub Question -------------------------
        if (isset($request->sub_question_enable)) { 
            $sub_question_status = $request->sub_question_enable;
            $opt_explode = explode(',', $request->options_list);
            array_unshift($opt_explode, "options_0");
            $options_explode =  array_filter($opt_explode);

            if ($request->sub_question_type == 1) {
                $sub_text_question = array_filter($request->sub_text_question);
                $sub_questions = implode('||', $sub_text_question);

            } elseif ($request->sub_question_type == 2) {
                if ($request->hasFile('sub_img_question')) {
                    $files = $request->file('sub_img_question');

                    foreach ($files as $file) {
                        $file_name = rand(3,6) . '_' . $file->getClientOriginalName();

                        $destinationPath = public_path() . '/assets/uploads/sub_questions/images/';
                        $file->move($destinationPath, $file_name);

                        $sub_img_questions[] = $file_name;
                    }
                }
                $sub_questions = implode('||', $sub_img_questions);
            } elseif ($request->sub_question_type == 3) {
                if ($request->hasFile('sub_sound_question')) {
                    $files = $request->file('sub_sound_question');

                    foreach ($files as $file) {
                        $file_name = rand(3,6) . '_' . $file->getClientOriginalName();

                        $destinationPath = public_path() . '/assets/uploads/sub_questions/sounds/';
                        $file->move($destinationPath, $file_name);

                        $sub_sound_questions[] = $file_name;
                    }
                }
                $sub_questions = implode('||', $sub_sound_questions);
            }

            if ($request->sub_option_type == 1) {
                foreach ($options_explode as $key => $value) {
                    $explode_value = explode('_', $value);
                    $req_data = 'sub_text_options_' . $explode_value[1];
                    $options[] = $request->$req_data;
                    $option[] = implode('||', $options[$key]);
                }
                $insert_option = implode('~~', $option);
            } elseif ($request->sub_option_type == 2) {
                foreach ($options_explode as $key => $value) {
                    $explode_value = explode('_', $value);

                    $sub_opt = 'sub_img_options_' . $explode_value[1];

                    if ($request->hasFile($sub_opt)) {
                        $files = $request->file($sub_opt);

                        $img_sub_options = [];
                        foreach ($files as $file) {
                            $file_name = rand(3,6) . '_' . $file->getClientOriginalName();

                            $destinationPath = public_path() . '/assets/uploads/sub_options/images';
                            $file->move($destinationPath, $file_name);
                            array_push($img_sub_options, $file_name);
                        }
                        $sub_option_implode[] = implode('||', $img_sub_options);
                    }
                }
                $insert_option = implode('~~', $sub_option_implode);
            } elseif ($request->sub_option_type == 3) {
                foreach ($options_explode as $key => $value) {
                    $explode_value = explode('_', $value);

                    $sub_opt = 'sub_sound_options_' . $explode_value[1];

                    if ($request->hasFile($sub_opt)) {
                        $files = $request->file($sub_opt);

                        $sound_sub_options = [];
                        foreach ($files as $file) {
                            $file_name = rand(3,6) . '_' . $file->getClientOriginalName();

                            $destinationPath = public_path() . '/assets/uploads/sub_options/sounds';
                            $file->move($destinationPath, $file_name);
                            array_push($sound_sub_options, $file_name);
                        }
                        $sub_option_implode[] = implode('||', $sound_sub_options);
                    }
                }
                $insert_option = implode('~~', $sub_option_implode);
            }
            $request_sub_correct_answer = array_filter($request->sub_right_answer);
            $sub_correct_answer = implode('||', $request_sub_correct_answer);

            $insert_data->sub_question_status = $sub_question_status;
            $insert_data->sub_question_type = $request->sub_question_type;
            $insert_data->sub_question = $sub_questions;
            $insert_data->sub_option_type = $request->sub_option_type;
            $insert_data->sub_options = $insert_option;
            $insert_data->sub_correct_answer = $sub_correct_answer;
        } else {
            $option_type = ($request->option_type? $request->option_type:'');

            if ($option_type == 1) {
                $options_req = $request->text_options;
                $options = implode('||', $options_req);
            } elseif ($option_type == 2) {

                if ($request->hasFile('img_options')) {
                    $files = $request->file('img_options');

                    foreach ($files as $file) {
                        $file_name = rand(3,6) . '_' . $file->getClientOriginalName();

                        $destinationPath = public_path() . '/assets/uploads/options/images';
                        $file->move($destinationPath, $file_name);

                        $img_options[] = $file_name;
                    }
                }
                $options = implode('||', $img_options);
            } elseif ($option_type == 3) {

                if ($request->hasFile('sound_options')) {
                    $files = $request->file('sound_options');

                    foreach ($files as $file) {
                        $file_name = rand(3,6) . '_' . $file->getClientOriginalName();

                        $destinationPath = public_path() . '/assets/uploads/options/sounds';
                        $file->move($destinationPath, $file_name);

                        $sound_options[] = $file_name;
                    }
                }
                $options = implode('||', $sound_options);
            } else {
                $options = '';
            }

            $correct_answer = $request->right_answer;

            $insert_data->option_type = $request->option_type;
            $insert_data->options = $options;
            $insert_data->correct_answer = $correct_answer;
        }

        $testData = TestList::find($item_for);

        $insert_data->save();
        //session()->flash('success', 'Post successfully updated.');

        return redirect('/create-new-item/')->with('success', $testData->name . ' Item has been successfully created.');
        //return redirect('/items/' . $item_for . '/' . $status)->with('success', $testData->name . ' Item has been successfully created.');
    }

    public function editItems($id)
    {
        $item               = ItemBank::find($id);
        $item_levels        = ItemLevel::get();
        $item_categories    = ItemCategory::get();
        $item_tag1          = ItemTag1::get();
        $item_tag2          = ItemTag2::get();
        $item_tag3          = ItemTag3::get();
        $item_tag4          = ItemTag4::get();
        $item_tag5          = ItemTag5::get();
        $item_tag6          = ItemTag6::get();
        $item_tag7          = ItemTag7::get();
        $test_list          = TestList::get();
        $test_list          = TestList::get();
        $item_statuses      = ItemStatus::orderBy('sl_no', 'asc')->get();

        return view('edit_items', compact('item', 'item_levels', 'item_categories', 'test_list','item_tag1','item_tag2','item_tag3','item_tag4','item_tag5','item_tag6','item_tag7', 'item_statuses'));
    }

    public function updateItems(Request $request, $id)
    {

        $item_for = $request->item_for;
        $status = $request->publish_test;

        $insert_data = ItemBank::find($id);

        if ($insert_data->sub_question_status == 1) {
            $previous_sub_question = explode('||', $insert_data->sub_question);
            $previous_sub_option = explode('~~', $insert_data->sub_options);
            $removed_sub_question = explode(',', $request->removed_sub_question);

            foreach ($removed_sub_question as $key => $remove_sub_question) {
                if ($remove_sub_question != null) {
                    $previous_removed_sub_question[] = $previous_sub_question[$remove_sub_question];
                    $previous_removed_sub_option[] = $previous_sub_option[$remove_sub_question];

                    $full_path_img = public_path() . '/assets/uploads/sub_questions/images/' . $previous_removed_sub_question[$key];
                    $full_path_sound = public_path() . '/assets/uploads/sub_questions/sounds/' . $previous_removed_sub_question[$key];
                    if (file_exists($full_path_img)) {
                        unlink($full_path_img);
                    }
                    if (file_exists($full_path_sound)) {
                        unlink($full_path_sound);
                    }

                    $prev_remove_sub_option_explode = explode('||', $previous_removed_sub_option[$key]);

                    foreach ($prev_remove_sub_option_explode as $prev_remove_sub_option) {
                        $full_path_sub_img = public_path() . '/assets/uploads/sub_options/images/' . $prev_remove_sub_option;
                        $full_path_sub_sound = public_path() . '/assets/uploads/sub_options/sounds/' . $prev_remove_sub_option;

                        if (file_exists($full_path_sub_img)) {
                            unlink($full_path_sub_img);
                        }
                        if (file_exists($full_path_sub_sound)) {
                            unlink($full_path_sub_sound);
                        }
                    }
                } else {
                    $previous_removed_sub_question = [''];
                    $previous_removed_sub_option = [''];
                }
            }
            $old_sub_question = array_diff($previous_sub_question, $previous_removed_sub_question);
            $old_sub_option = array_values(array_diff($previous_sub_option, $previous_removed_sub_option));

            // start sub options remove
            $previous_sub_options = explode('~~', $insert_data->sub_options); // previous all sub options from database

            $remove_req_sub_options = explode(',', $request->sub_options_remove); // removed sub options request from form

            if ($remove_req_sub_options[0] != null) {
                foreach ($remove_req_sub_options as $key => $remove_req_sub_option) {        // loop for total request removed sub option

                    $remove_single_sub_option = explode('_', $remove_req_sub_option);   // remove requested sub option explode

                    // ( $remove_single_sub_option[0] ) is sub question no. and ( $remove_single_sub_option[1]-1 ) is sub option no.

                    $previous_sub_option = explode('||', $previous_sub_options[$remove_single_sub_option[0]]); // individual sub option, this type image or sound. This option for remove.
                    $removed_sub_option[] = $previous_sub_option[$remove_single_sub_option[1]];     // removed from database sub option names.

                    // unlink image option files from folder
                    $full_path_img_options = public_path() . '/assets/uploads/sub_options/images/' . $removed_sub_option[$key];
                    if (file_exists($full_path_img_options)) {
                        unlink($full_path_img_options);
                    }

                    // unlink sound option files from folder
                    $full_path_sound_options = public_path() . '/assets/uploads/sub_options/sounds/' . $removed_sub_option[$key];
                    if (file_exists($full_path_sound_options)) {
                        unlink($full_path_sound_options);
                    }
                }

                if ($remove_req_sub_options[0] != null && $request->removed_sub_question == null) {
                    // get old options name from database after remove requested options
                    foreach ($previous_sub_options as $key => $prev_sub_options) {  // previous total options loop
                        $explode_prev_sub_options = explode('||', $prev_sub_options);  // previous individual sub question explode for get individual options

                        $old_sub_opt[] = array_diff($explode_prev_sub_options, $removed_sub_option); // match previous all database options with removed options name
                        $old_sub_option_implode[] = implode('||', $old_sub_opt[$key]);               //  implode not removed options name, this name save again in database
                    }
                }

                //dd($previous_sub_options, $removed_sub_option,$old_sub_opt, $old_sub_option_implode);

            }

            // /. end sub options remove

            // multiple removed

            if ($request->removed_sub_question != null && $remove_req_sub_options[0] != null) {

                $i = 0;
                foreach ($old_sub_option as $prev_sub_options) {  // previous total options loop
                    $explode_prev_sub_options = explode('||', $prev_sub_options);  // previous individual sub question explode for get individual options

                    $old_sub_opt[] = array_diff($explode_prev_sub_options, $removed_sub_option); // match previous all database options with removed options name
                    $old_sub_option_implode[] = implode('||', $old_sub_opt[$i]);               //  implode not removed options name, this name save again in database
                    $i++;
                }
            }
        }

        // note
        //$old_sub_option for question
        // $old_sub_opt after individual remove
        // $old_sub_option_implode individual options implode


        //dd($old_sub_option, $old_sub_opt, $old_sub_option_implode);

        $insert_data->name = $request->question_name;
        $insert_data->item_for = $request->item_for;
        $insert_data->level = $request->question_level;
        $insert_data->category = $request->question_category;
        $insert_data->tag1 = $request->question_tag1;
        $insert_data->tag2 = $request->question_tag2;
        $insert_data->tag3 = $request->question_tag3;
        $insert_data->tag4 = $request->question_tag4;
        $insert_data->tag5 = $request->question_tag5;
        $insert_data->tag6 = $request->question_tag6;
        $insert_data->tag7 = $request->question_tag7;
        $insert_data->top_text = $request->top_text;
        $insert_data->down_text = $request->down_text;
        $insert_data->item_type = $request->question_type;
        $insert_data->item_status = $request->publish_test;

        if ($request->question_type == 1) {
            $full_path_img = public_path() . '/assets/uploads/questions/images/' . $insert_data->item;
            if (file_exists($full_path_img)) {
                unlink($full_path_img);
            }
            $full_path_sound = public_path() . '/assets/uploads/questions/sounds/' . $insert_data->item;
            if (file_exists($full_path_sound)) {
                unlink($full_path_sound);
            }

            $item = $request->item_text;
        } elseif ($request->question_type == 2) {
            if ($request->hasFile('item_img')) {
                $file = $request->file('item_img');

                $full_path_img = public_path() . '/assets/uploads/questions/images/' . $insert_data->item;
                if (file_exists($full_path_img)) {
                    unlink($full_path_img);
                }
                $full_path_sound = public_path() . '/assets/uploads/questions/sounds/' . $insert_data->item;
                if (file_exists($full_path_sound)) {
                    unlink($full_path_sound);
                }

                $file_name = str_random(3) . '_' . $file->getClientOriginalName();
                $destinationPath = public_path() . '/assets/uploads/questions/images/';
                $file->move($destinationPath, $file_name);
                $item = $file_name;
            }
        } elseif ($request->question_type == 3) {
            if ($request->hasFile('item_sound')) {
                $file = $request->file('item_sound');

                $full_path_img = public_path() . '/assets/uploads/questions/images/' . $insert_data->item;
                if (file_exists($full_path_img)) {
                    unlink($full_path_img);
                }
                $full_path_sound = public_path() . '/assets/uploads/questions/sounds/' . $insert_data->item;
                if (file_exists($full_path_sound)) {
                    unlink($full_path_sound);
                }

                $file_name = str_random(3) . '_' . $file->getClientOriginalName();
                $destinationPath = public_path() . '/assets/uploads/questions/sounds/';
                $file->move($destinationPath, $file_name);
                $item = $file_name;
            }
        }

        if (isset($item)) {
            $insert_data->item = $item;
        }

        if (isset($request->sub_question_enable)) {

            if ($request->type_change_status != 1) {

                $sub_question_status = $request->sub_question_enable;
                $opt_explode = explode(',', $request->options_list);
                $options_explode =  array_filter($opt_explode);

                if ($request->sub_question_type == 1) {
                    $sub_text_question = array_filter($request->sub_text_question);
                    $sub_questions = $sub_text_question;
                } elseif ($request->sub_question_type == 2) {
                    if ($request->hasFile('sub_img_question')) {
                        $files = $request->file('sub_img_question');
                        $files_filter = array_filter($files);

                        foreach ($files_filter as $file) {
                            $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                            $destinationPath = public_path() . '/assets/uploads/sub_questions/images/';
                            $file->move($destinationPath, $file_name);

                            $sub_img_questions[] = $file_name;
                        }
                    }
                    if (isset($sub_img_questions)) {

                        if ($request->change_sub_question != null) {
                            $pre_all_sub_qt = explode('||', $insert_data->sub_question);
                            $remove_sub_qt = explode(',', $request->change_sub_question);

                            foreach ($remove_sub_qt as $key => $remove_sub_qt_value) {
                                if ($remove_sub_qt_value != null) {
                                    $prev_remove_sub_qt[] = $pre_all_sub_qt[$remove_sub_qt_value];

                                    $full_path_img = public_path() . '/assets/uploads/sub_questions/images/' . $prev_remove_sub_qt[$key];
                                    $full_path_sound = public_path() . '/assets/uploads/sub_questions/sounds/' . $prev_remove_sub_qt[$key];
                                    if (file_exists($full_path_img)) {
                                        unlink($full_path_img);
                                    }
                                    if (file_exists($full_path_sound)) {
                                        unlink($full_path_sound);
                                    }
                                }
                                array_splice($pre_all_sub_qt, $remove_sub_qt_value, 1, $sub_img_questions[$key]);
                            }

                            $sub_questions = $pre_all_sub_qt;
                        } else {
                            $sub_questions = $sub_img_questions;
                        }
                    }
                } elseif ($request->sub_question_type == 3) {
                    if ($request->hasFile('sub_sound_question')) {

                        $files = $request->file('sub_sound_question');
                        $files_filter = array_filter($files);

                        foreach ($files_filter as $file) {
                            $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                            $destinationPath = public_path() . '/assets/uploads/sub_questions/sounds/';
                            $file->move($destinationPath, $file_name);

                            $sub_sound_questions[] = $file_name;
                        }
                    }
                    if (isset($sub_sound_questions)) {

                        if ($request->change_sub_question != null) {
                            $pre_all_sub_qt = explode('||', $insert_data->sub_question);
                            $remove_sub_qt = explode(',', $request->change_sub_question);

                            foreach ($remove_sub_qt as $key => $remove_sub_qt_value) {
                                if ($remove_sub_qt_value != null) {
                                    $prev_remove_sub_qt[] = $pre_all_sub_qt[$remove_sub_qt_value];

                                    $full_path_img = public_path() . '/assets/uploads/sub_questions/images/' . $prev_remove_sub_qt[$key];
                                    $full_path_sound = public_path() . '/assets/uploads/sub_questions/sounds/' . $prev_remove_sub_qt[$key];
                                    if (file_exists($full_path_img)) {
                                        unlink($full_path_img);
                                    }
                                    if (file_exists($full_path_sound)) {
                                        unlink($full_path_sound);
                                    }
                                }
                                array_splice($pre_all_sub_qt, $remove_sub_qt_value, 1, $sub_sound_questions[$key]);
                            }

                            $sub_questions = $pre_all_sub_qt;
                        } else {
                            $sub_questions = $sub_sound_questions;
                        }
                    }
                }

                if (isset($old_sub_question)) {
                    if (isset($sub_questions) && !(isset($sub_text_question))) {

                        // new changed 8.33 pm
                        if (isset($pre_all_sub_qt)) {
                            $insert_sub_question = $pre_all_sub_qt;
                        } else {
                            $insert_sub_question = array_merge($old_sub_question, $sub_questions);
                        }
                    } else if (isset($sub_text_question)) {
                        $insert_sub_question = $sub_text_question;
                    } else {
                        $insert_sub_question = $old_sub_question;
                    }
                } else {
                    if (isset($sub_questions)) {
                        $insert_sub_question = $sub_questions;
                    }
                }

                $insert_data->sub_question = implode('||', $insert_sub_question);
                $text_options = [];
                if ($request->sub_option_type == 1) {
                    foreach ($options_explode as $key => $value) {
                        $explode_value = explode('_', $value);
                        $req_data = 'sub_text_options_' . $explode_value[1];
                        $options = $request->$req_data;
                        $imploded[] = implode('||', $options);
                    }
                    $text_options = implode('~~', $imploded);
                    $insert_data->sub_options = $text_options;
                }

                // text sub options
                elseif ($request->sub_option_type == 2) // for sub option type
                {
                    foreach ($options_explode as $key => $value) { // from option list (options_0, options_1, options_2)
                        $explode_value = explode('_', $value); // explode _ value for get 0,1,2

                        $sub_opt = 'sub_img_options_' . $explode_value[1];  // get request input field name

                        if ($request->hasFile($sub_opt)) { // check file type

                            $files = $request->file($sub_opt); // all files in a array
                            $files_filtered = array_filter($files);
                            // remove null value from files array

                            $img_sub_options = [];                  // all individual options in an array
                            foreach ($files_filtered as $file) {    //filtered files loop
                                $file_name = str_random(3) . '_' . $file->getClientOriginalName(); // filename

                                $destinationPath = public_path() . '/assets/uploads/sub_options/images';
                                $file->move($destinationPath, $file_name);
                                array_push($img_sub_options, $file_name); // push file name for individual options name

                            }
                            $sub_option_implode[] = implode('||', $img_sub_options); // implode single sub question options
                        } else {
                            $sub_option_implode[] = '';
                        }
                    }
                } elseif ($request->sub_option_type == 3) {
                    foreach ($options_explode as $key => $value) {
                        $explode_value = explode('_', $value);

                        $sub_opt = 'sub_sound_options_' . $explode_value[1];

                        if ($request->hasFile($sub_opt)) {
                            $files = $request->file($sub_opt);
                            $files_filtered = array_filter($files);

                            $sound_sub_options = [];
                            foreach ($files_filtered as $file) {
                                $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                                $destinationPath = public_path() . '/assets/uploads/sub_options/sounds';
                                $file->move($destinationPath, $file_name);
                                array_push($sound_sub_options, $file_name);
                            }
                            $sub_option_implode[] = implode('||', $sound_sub_options);
                        } else {
                            $sub_option_implode[] = '';
                        }
                    }
                    //$insert_option = implode('~~', $sub_option_implode);
                }

                $merge_sub_option = [];
                if (isset($old_sub_option_implode) && ($request->sub_option_type == 2 || $request->sub_option_type == 3)) {

                    /*  $insert_sub_question=array_filter($insert_sub_question);
                      $sub_option_implode=array_filter($sub_option_implode);*/


                    if ($sub_option_implode) {
                        //dd('a',$sub_option_implode,$old_sub_option_implode,$insert_sub_question);
                        /* $old_sub_option_implode=array_filter($old_sub_option_implode);*/


                        for ($i = 0; $i < count($insert_sub_question); $i++) {
                            if ((isset($sub_option_implode[$i]) && $sub_option_implode[$i]) && (isset($old_sub_option_implode[$i]) && $old_sub_option_implode[$i])) {

                                array_push($merge_sub_option, $old_sub_option_implode[$i] . '||' . $sub_option_implode[$i]);
                            } else if ((isset($sub_option_implode[$i]) && $sub_option_implode[$i])) {
                                array_push($merge_sub_option, $sub_option_implode[$i]);
                            } else if ((isset($old_sub_option_implode[$i]) && $old_sub_option_implode[$i]) && !(isset($sub_option_implode[$i]) && $sub_option_implode[$i])) {
                                array_push($merge_sub_option, $old_sub_option_implode[$i]);
                            }
                        }

                        $sub_options = implode('~~', $merge_sub_option);
                        $insert_data->sub_options = $sub_options;
                    }
                } else if (($request->sub_option_type == 2 || $request->sub_option_type == 3)) {

                    //dd($insert_sub_question,$sub_option_implode,$old_sub_option);
                    /*  $insert_sub_question=array_values($insert_sub_question);
                      $old_sub_option=array_values($old_sub_option);
                      $sub_option_implode=array_values($sub_option_implode);*/

                    for ($i = 0; $i < count($insert_sub_question); $i++) {
                        if ((isset($sub_option_implode[$i]) && $sub_option_implode[$i]) && (isset($old_sub_option[$i]) && $sub_option_implode[$i])) {
                            array_push($merge_sub_option, $old_sub_option[$i] . '||' . $sub_option_implode[$i]);
                        } else if (isset($sub_option_implode[$i]) && $sub_option_implode[$i]) {
                            array_push($merge_sub_option, $sub_option_implode[$i]);
                        } else if ((isset($old_sub_option[$i]) && $old_sub_option[$i])) {
                            array_push($merge_sub_option, $old_sub_option[$i]);
                        }
                    }
                    $sub_options = implode('~~', $merge_sub_option);
                    $insert_data->sub_options = $sub_options;
                }


                $request_sub_correct_answer = array_filter($request->sub_right_answer);
                $sub_correct_answer = implode('||', $request_sub_correct_answer);
                $insert_data->sub_question_status = $sub_question_status;
                $insert_data->sub_question_type = $request->sub_question_type;
                $insert_data->sub_option_type = $request->sub_option_type;
                $insert_data->sub_correct_answer = $sub_correct_answer;
            } else {

                // unlink previous all files form directory

                $previous_sub_question = explode('||', $insert_data->sub_question);
                $previous_sub_option = explode('~~', $insert_data->sub_options);

                foreach ($previous_sub_question as $key => $remove_sub_question) {

                    $full_path_img = public_path() . '/assets/uploads/sub_questions/images/' . $remove_sub_question;
                    $full_path_sound = public_path() . '/assets/uploads/sub_questions/sounds/' . $remove_sub_question;
                    if (file_exists($full_path_img)) {
                        unlink($full_path_img);
                    }
                    if (file_exists($full_path_sound)) {
                        unlink($full_path_sound);
                    }

                    $prev_remove_sub_option_explode = explode('||', $previous_sub_option[$key]);

                    foreach ($prev_remove_sub_option_explode as $prev_remove_sub_option) {
                        $dd[] = $prev_remove_sub_option;
                        $full_path_sub_img = public_path() . '/assets/uploads/sub_options/images/' . $prev_remove_sub_option;
                        $full_path_sub_sound = public_path() . '/assets/uploads/sub_options/sounds/' . $prev_remove_sub_option;

                        if (file_exists($full_path_sub_img)) {
                            unlink($full_path_sub_img);
                        }
                        if (file_exists($full_path_sub_sound)) {
                            unlink($full_path_sub_sound);
                        }
                    }
                }


                $sub_question_status = $request->sub_question_enable;
                $opt_explode = explode(',', $request->options_list);
                array_unshift($opt_explode, "options_0");
                $options_explode =  array_filter($opt_explode);

                if ($request->sub_question_type == 1) {
                    $sub_text_question = array_filter($request->sub_text_question);
                    $sub_questions = implode('||', $sub_text_question);
                } elseif ($request->sub_question_type == 2) {
                    if ($request->hasFile('sub_img_question')) {
                        $files = $request->file('sub_img_question');

                        foreach ($files as $file) {
                            $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                            $destinationPath = public_path() . '/assets/uploads/sub_questions/images/';
                            $file->move($destinationPath, $file_name);

                            $sub_img_questions[] = $file_name;
                        }
                    }
                    $sub_questions = implode('||', $sub_img_questions);
                } elseif ($request->sub_question_type == 3) {
                    if ($request->hasFile('sub_sound_question')) {
                        $files = $request->file('sub_sound_question');

                        foreach ($files as $file) {
                            $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                            $destinationPath = public_path() . '/assets/uploads/sub_questions/sounds/';
                            $file->move($destinationPath, $file_name);

                            $sub_sound_questions[] = $file_name;
                        }
                    }
                    $sub_questions = implode('||', $sub_sound_questions);
                }

                if ($request->sub_option_type == 1) {
                    foreach ($options_explode as $key => $value) {
                        $explode_value = explode('_', $value);
                        $req_data = 'sub_text_options_' . $explode_value[1];
                        $options[] = $request->$req_data;
                        $option[] = implode('||', $options[$key]);
                    }
                    $insert_option = implode('~~', $option);
                } elseif ($request->sub_option_type == 2) {
                    foreach ($options_explode as $key => $value) {
                        $explode_value = explode('_', $value);

                        $sub_opt = 'sub_img_options_' . $explode_value[1];

                        if ($request->hasFile($sub_opt)) {
                            $files = $request->file($sub_opt);

                            $img_sub_options = [];
                            foreach ($files as $file) {
                                $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                                $destinationPath = public_path() . '/assets/uploads/sub_options/images';
                                $file->move($destinationPath, $file_name);
                                array_push($img_sub_options, $file_name);
                            }
                            $sub_option_implode[] = implode('||', $img_sub_options);
                        }
                    }
                    $insert_option = implode('~~', $sub_option_implode);
                } elseif ($request->sub_option_type == 3) {
                    foreach ($options_explode as $key => $value) {
                        $explode_value = explode('_', $value);

                        $sub_opt = 'sub_sound_options_' . $explode_value[1];

                        if ($request->hasFile($sub_opt)) {
                            $files = $request->file($sub_opt);

                            $sound_sub_options = [];
                            foreach ($files as $file) {
                                $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                                $destinationPath = public_path() . '/assets/uploads/sub_options/sounds';
                                $file->move($destinationPath, $file_name);
                                array_push($sound_sub_options, $file_name);
                            }
                            $sub_option_implode[] = implode('||', $sound_sub_options);
                        }
                    }
                    $insert_option = implode('~~', $sub_option_implode);
                }
                $request_sub_correct_answer = array_filter($request->sub_right_answer);
                $sub_correct_answer = implode('||', $request_sub_correct_answer);

                $insert_data->sub_question_status = $sub_question_status;
                $insert_data->sub_question_type = $request->sub_question_type;
                $insert_data->sub_question = $sub_questions;
                $insert_data->sub_option_type = $request->sub_option_type;
                $insert_data->sub_options = $insert_option;
                $insert_data->sub_correct_answer = $sub_correct_answer;
            }
        } else {
            $option_type = $request->option_type;

            $previous_options = explode('||', $insert_data->options);
            if ($request->removeOptions != null) {
                $removed_options = explode(',', $request->removeOptions);

                foreach ($removed_options as $key => $removed_option) {
                    if ($removed_option != null) {
                        $previous_removed_options[] = $previous_options[$removed_option];

                        $full_path_img = public_path() . '/assets/uploads/options/images/' . $previous_removed_options[$key];
                        $full_path_sound = public_path() . '/assets/uploads/options/sounds/' . $previous_removed_options[$key];
                        if (file_exists($full_path_img)) {
                            unlink($full_path_img);
                        }
                        if (file_exists($full_path_sound)) {
                            unlink($full_path_sound);
                        }
                    }
                }
                $old_options = array_diff($previous_options, $previous_removed_options);
            }

            if ($option_type == 1) {
                $options_req = $request->text_options;
                $options = implode('||', $options_req);
            } elseif ($option_type == 2) {
                if ($request->hasFile('img_options')) {
                    $files = $request->file('img_options');

                    foreach ($files as $file) {
                        $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                        $destinationPath = public_path() . '/assets/uploads/options/images';
                        $file->move($destinationPath, $file_name);

                        $img_options[] = $file_name;
                    }
                }
                if (isset($img_options) && isset($old_options)) {
                    $options_merge = array_merge($old_options, $img_options);
                    $options = implode('||', $options_merge);
                } elseif (isset($img_options)) {
                    $options_merge = array_merge($previous_options, $img_options);
                    $options = implode('||', $options_merge);
                } elseif (isset($old_options)) {
                    $options = implode('||', $old_options);
                }
            } elseif ($option_type == 3) {

                if ($request->hasFile('sound_options')) {
                    $files = $request->file('sound_options');

                    foreach ($files as $file) {
                        $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                        $destinationPath = public_path() . '/assets/uploads/options/sounds';
                        $file->move($destinationPath, $file_name);

                        $sound_options[] = $file_name;
                    }
                }
                if (isset($sound_options) && isset($old_options)) {
                    $options_merge = array_merge($old_options, $sound_options);
                    $options = implode('||', $options_merge);
                } elseif (isset($sound_options)) {
                    $options_merge = array_merge($previous_options, $sound_options);
                    $options = implode('||', $options_merge);
                } elseif (isset($old_options)) {
                    $options = implode('||', $old_options);
                }
            }
            $correct_answer = $request->right_answer;

            $insert_data->option_type = $request->option_type;
            if (isset($options)) {
                $insert_data->options = $options;
            }
            $insert_data->correct_answer = $correct_answer;
        }

        $test_list = TestList::get()->toArray();

        $insert_data->save();
        return redirect('/items/' . $item_for . '/' . $status)->with('success', $test_list[$item_for - 1]['name'] . ' Item has been successfully updated.');
    }

    public function activateItem(Request $request)
    {

        if ($request->data[0] == 'all') {
            $activate = ItemBank::where('item_for', $request->item_for)->where('item_status', 2)->select('id')->get()->toArray();

            foreach ($activate as $id) {
                $activate = ItemBank::find($id['id']);
                $activate->item_status = 1;
                $activate->save();
            }
        } else {
            foreach ($request->data as $id) {
                $activate = ItemBank::find($id);
                $activate->item_status = 1;
                $activate->save();
            }
        }
        return ($request->item_for);
    }

    public function destroyItem($id)
    {
        $delete = ItemBank::find($id);

        // destroy item files
        $full_path_img = public_path() . '/assets/uploads/questions/images/' . $delete->item;
        if (file_exists($full_path_img)) {
            unlink($full_path_img);
        }
        $full_path_sound = public_path() . '/assets/uploads/questions/sounds/' . $delete->item;
        if (file_exists($full_path_sound)) {
            unlink($full_path_sound);
        }

        // destroy sub questions and options
        if ($delete->sub_question_status == 1) {
            $previous_sub_questions = explode('||', $delete->sub_question);
            $previous_sub_option = explode('~~', $delete->sub_options);

            foreach ($previous_sub_questions as $key => $previous_sub_question) {
                if ($previous_sub_question != null) {

                    $full_path_img = public_path() . '/assets/uploads/sub_questions/images/' . $previous_sub_question;
                    $full_path_sound = public_path() . '/assets/uploads/sub_questions/sounds/' . $previous_sub_question;
                    if (file_exists($full_path_img)) {
                        unlink($full_path_img);
                    }
                    if (file_exists($full_path_sound)) {
                        unlink($full_path_sound);
                    }
                    $prev_sub_option_explode = explode('||', $previous_sub_option[$key]);

                    foreach ($prev_sub_option_explode as $prev_sub_option) {
                        $full_path_sub_img = public_path() . '/assets/uploads/sub_options/images/' . $prev_sub_option;
                        $full_path_sub_sound = public_path() . '/assets/uploads/sub_options/sounds/' . $prev_sub_option;

                        if (file_exists($full_path_sub_img)) {
                            unlink($full_path_sub_img);
                        }
                        if (file_exists($full_path_sub_sound)) {
                            unlink($full_path_sub_sound);
                        }
                    }
                }
            }
        } else {
            // destroy single options
            $options_explode = explode('||', $delete->options);
            foreach ($options_explode as $options) {
                $full_path_img_opt = public_path() . '/assets/uploads/options/images/' . $options;
                $full_path_sound_opt = public_path() . '/assets/uploads/options/sounds/' . $options;
                if (file_exists($full_path_img_opt)) {
                    unlink($full_path_img_opt);
                }
                if (file_exists($full_path_sound_opt)) {
                    unlink($full_path_sound_opt);
                }
            }
        }

        $delete->delete();
        return ('success');
    }

    public function questionSetNavigation()
    {
        $test_list = TestList::get();
        return view('question_set_navigation', compact('test_list'));
    }


    public function questionSetAndTestConfigurationList(){

        $questions_set = QuestionSet::with('itemFor','candidateType')->paginate(20);
        $test_config_list = TestConfiguration::with('testFor')->paginate(20);

        return view('question_set_and_test_list', compact('questions_set','test_config_list'));
    }

    public function questionSetList(){
        $questions_set = QuestionSet::with('itemFor','candidateType')->paginate(20);
        return view('question_set_list',compact('questions_set'));
    }



    public function questionSet($set_for)
    {
        $candidate_type = CandidateType::get();
        $test_list = TestList::get();
        $questions_set = QuestionSet::where('item_set_for', $set_for)->paginate(20);
        return view('question_set_list', compact('questions_set', 'set_for', 'candidate_type', 'test_list'));
    }

    public function createSets()
    {
        $test_list = TestList::where('status', '=', 1)->get();
        return view('create_set', compact('test_list'));
    }

    public function setRedirect(Request $request)
    {
        $item_set_for = $request->item_set_for;
        $item_set_name = $request->item_set_name;
        $item_configuration_type = $request->set_configuration_type;
        $total_item = $request->total_item;

        Session::put('item_set_for', $item_set_for);
        Session::put('item_set_name', $item_set_name);
        Session::put('item_configuration_type', $item_configuration_type);
        Session::put('total_item', $total_item);

        return redirect('/create-question-set');
    }

    public function createItemSet()
    {

        $item_set_for = Session::get('item_set_for');
        $item_set_name = Session::get('item_set_name');
        $item_configuration_type = Session::get('item_configuration_type');
        $total_item = Session::get('total_item');

        $test_list = TestList::get();
        $candidate_type = CandidateType::select('id', 'name')->get();
        $item_levels = ItemLevel::select('id', 'name')->get();

        if ($item_configuration_type == 1) {

            $counts = [];
            foreach ($item_levels as $level) {
                $count = ItemBank::Where('level', $level->id)->Where('item_for', $item_set_for)->WhereIn('item_status', [1,3,4])->count();
                if ($count != 0) {

                    $counts = $this->array_push_assoc($counts, $level->name, $count);
                }
            }
            return view('create_random_item_set', compact('item_set_for', 'test_list', 'candidate_type', 'item_set_name', 'counts', 'total_item'));
        } elseif ($item_configuration_type == 2) {

            $item_bank = ItemBank::WhereIn('item_status', [1,3,4])->Where('item_for', $item_set_for)->paginate(10);
            return view('create_static_item_set', compact('item_set_for', 'test_list', 'candidate_type', 'item_set_name', 'item_bank', 'item_levels', 'total_item'));
        } else {
            return redirect('/create-set')->with('choose', 'Please fill this form.');
        }
    }

    public function storeItemSet(Request $request)
    {
        $insert_data                 = new QuestionSet();
        $insert_data->item_set_name  = $request->item_set_name;
        $insert_data->item_set_for   = $request->item_set_for;
        $insert_data->candidate_type = $request->candidate_type;
        $insert_data->set_type       = strtolower($request->set_type);
        // $insert_data->set_level      = strtolower($request->set_level);
        // $insert_data->set_category   = strtolower($request->set_category);

        // random questions id generate
        if ($request->set_configuration_type == 1) {
            $total_items = $request->total_item;
            $item_levels = ItemLevel::select('id', 'name')->get();
            $counts = [];
            foreach ($item_levels as $key => $level) {
                $count = ItemBank::Where('item_for', $request->item_set_for)->Where('level', $level->id)->count();

                if ($count != 0) {
                    $counts = $this->array_push_assoc($counts, $level->name, $count);
                }
                if (isset($counts[$level->name])) {
                    $value =  $level->name;
                    $level_id = $level->id;
                    $total_request =  $request->$value;

                    if ($total_request != null) {
                        $question_levels[] = $level_id . '||' . $total_request;
                    }
                    $questions[] = ItemBank::select('id')->where('item_for', $request->item_set_for)->where('level', $level->id)->inRandomOrder()->limit($total_request)->pluck('id')->toArray();
                }
            }

            foreach (array_filter($questions) as $value) {
                $question_numbers[] = implode('||', $value);
            }
            $questions_id = implode('||', $question_numbers);
            $item_level = implode('~~', array_filter($question_levels));
        } elseif ($request->set_configuration_type == 2) {
            if ($request->data[0] == 'all') {
                $item_number = ItemBank::Where('item_for', $request->item_set_for)->pluck('id')->toArray();
                $total_items = ItemBank::Where('item_for', $request->item_set_for)->count();

                $all_levels = ItemBank::Where('item_for', $request->item_set_for)->pluck('level')->toArray();
                $levels = array_count_values($all_levels);

                $item_levels = [];
                foreach ($levels as $key => $level) {
                    $singular_level = "$key" . '||' . $level;
                    array_push($item_levels, $singular_level);
                }
            } else {
                $item_level = [];
                $item_number = [];
                foreach ($request->data as $values) {
                    $exploding = explode('||', $values);

                    array_push($item_level, $exploding[1]);
                    array_push($item_number, $exploding[0]);
                }

                $levels = array_count_values($item_level);
                $item_levels = [];
                foreach ($levels as $key => $level) {
                    $singular_level = "$key" . '||' . $level;
                    array_push($item_levels, $singular_level);
                }
                $total_items = $request->total_item;
            }
            $questions_id = implode('||', $item_number);
            $item_level = implode('~~', $item_levels);
        }

        $insert_data->total_items            = $total_items;
        $insert_data->item_level             = $item_level;
        $insert_data->questions_id           = $questions_id;
        $insert_data->set_configuration_type = $request->set_configuration_type;
        // $insert_data->total_time = $request->total_time;
        // $insert_data->pass_mark = $request->pass_mark;

        $insert_data->save();

        Session::forget('item_set_for');
        Session::forget('item_set_name');
        Session::forget('item_configuration_type');
        Session::forget('total_item');

        return ($request->item_set_for);
    }

    public function editItemSet($id)
    {
        $item_set       = QuestionSet::find($id);
        $candidate_type = CandidateType::get();
        $test_list      = TestList::get();
        $item_set_for   = $item_set->item_set_for;
        $item_levels    = ItemLevel::select('id', 'name')->get();

        if ($item_set->set_configuration_type == 1) {
            $counts = [];
            foreach ($item_levels as $level) {
                $count = ItemBank::Where('level', $level->id)->Where('item_for', $item_set_for)->WhereIn('item_status', [1,3,4])->count();
                if ($count != 0) {
                    $counts = $this->array_push_assoc($counts, $level->name, $count);
                }
            }

            return view('edit_random_item_set', compact('item_set', 'candidate_type', 'test_list', 'item_set_for', 'counts'));
        } elseif ($item_set->set_configuration_type == 2) {
            $item_bank = ItemBank::Where('item_status', 1)->Where('item_for', $item_set_for)->paginate(10);
            return view('edit_static_item_set', compact('item_set', 'candidate_type', 'item_bank', 'item_levels', 'test_list', 'item_set_for'));
        }
    }

    public function updateItemSet(Request $request, $id)
    {
        $insert_data                 = QuestionSet::find($id);
        $insert_data->item_set_name  = $request->item_set_name;
        $insert_data->candidate_type = $request->candidate_type;
        $insert_data->set_type       = strtolower($request->set_type);
        // $insert_data->set_level      = strtolower($request->set_level);
        // $insert_data->set_category   = strtolower($request->set_category);

        //random question id generate
        if ($insert_data->set_configuration_type == 1) {
            if ($request->item_change_status > 0) {
                $total_items = $request->total_item;
                $item_levels = ItemLevel::select('id', 'name')->get();
                $counts = [];
                foreach ($item_levels as $key => $level) {
                    $count = ItemBank::Where('item_for', $request->item_set_for)->Where('level', $level->id)->count();

                    if ($count != 0) {
                        $counts = $this->array_push_assoc($counts, $level->name, $count);
                    }
                    if (isset($counts[$level->name])) {
                        $value =  $level->name;
                        $level_id = $level->id;
                        $total_request =  $request->$value;

                        if ($total_request != null) {
                            $question_levels[] = $level_id . '||' . $total_request;
                        }
                        $questions[] = ItemBank::select('id')->where('item_for', $request->item_set_for)->where('level', $level->id)->inRandomOrder()->limit($total_request)->pluck('id')->toArray();
                    }
                }

                foreach (array_filter($questions) as $value) {
                    $question_numbers[] = implode('||', $value);
                }
                $questions_id = implode('||', $question_numbers);
                $item_level = implode('~~', array_filter($question_levels));
            }
        } elseif ($insert_data->set_configuration_type == 2) {

            if ($request->data[0] == 'all') {
                $item_number = ItemBank::Where('item_for', $request->item_set_for)->WhereIn('item_status', [1,3])->pluck('id')->toArray();
                $total_items = ItemBank::Where('item_for', $request->item_set_for)->WhereIn('item_status', [1,3])->count();

                $all_levels = ItemBank::Where('item_for', $request->item_set_for)->pluck('level')->toArray();
                $levels = array_count_values($all_levels);

                $item_levels = [];
                foreach ($levels as $key => $level) {
                    $singular_level = "$key" . '||' . $level;
                    array_push($item_levels, $singular_level);
                }
            } else {
                if ($request->change_status > 0) {
                    $item_level = [];
                    $item_number = [];
                    foreach ($request->data as $values) {
                        $exploding = explode('||', $values);

                        array_push($item_level, $exploding[1]);
                        array_push($item_number, $exploding[0]);
                    }

                    $levels = array_count_values($item_level);
                    $item_levels = [];
                    foreach ($levels as $key => $level) {
                        $singular_level = "$key" . '||' . $level;
                        array_push($item_levels, $singular_level);
                    }
                    $total_items = $request->total_item;
                }
            }
            if (isset($item_number)) {
                $questions_id = implode('||', $item_number);
            }
            if (isset($item_levels)) {
                $item_level = implode('~~', $item_levels);
            }
        }

        if (isset($total_items)) {
            $insert_data->total_items = $total_items;
        }
        if (isset($item_level)) {
            $insert_data->item_level = $item_level;
        }
        if (isset($questions_id)) {
            $insert_data->questions_id = $questions_id;
        }
        // $insert_data->total_time = $request->total_time;
        // $insert_data->pass_mark = $request->pass_mark;
        $insert_data->set_configuration_type = $request->set_configuration_type;

        $insert_data->save();
        return ($insert_data->item_set_for);
    }

    public function destroyItemSet($id)
    {
        QuestionSet::find($id)->delete();
        return ('success');
    }


    // memory item list
    public function memoryItemList($status)
    {
        $items = MemoryBank::where('item_status', $status)->paginate(10);
        return view('memory_item_list', compact('items', 'status'));
    }

    // create memory item
    public function createMemoryItem()
    {
        $item_levels = ItemLevel::get();
        $item_categories = ItemCategory::get();
        return view('create_memory_item', compact('item_levels', 'item_categories'));
    }

    // upload and preview single sub question image
    public function uploadMemoryImage(Request $request)
    {

        $total_questions = explode(',', $request->total_question);
        array_unshift($total_questions, "0");

        foreach ($total_questions as $key => $total_question) {

            if ($request->hasFile('sub_question_images_' . $total_question)) {
                $files = $request->file('sub_question_images_' . $total_question);

                foreach ($files as $file) {
                    $file_name = str_random(3) . '_' . $file->getClientOriginalName();

                    $destinationPath = public_path() . '/assets/uploads/memory_options/';
                    $file->move($destinationPath, $file_name);

                    $memory_options[] = $file_name;
                }
            }
        }

        if (isset($memory_options)) {
            return ($memory_options);
        }
    }

    // delete single memory sub question
    public function removeMemoryImage(Request $request)
    {
        $explode_remove_data = explode(',', $request->sub_question_data);
        foreach ($explode_remove_data as $remove_data) {
            $file_path = public_path() . '/assets/uploads/memory_options/' . $remove_data;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        return ('success');
    }

    // store memory item
    public function storeMemoryItem(Request $request)
    {
        $question_name = $request->question_name;
        $question_level = $request->question_level;
        $question_category = $request->question_category;
        $top_text = $request->top_text;
        $down_text = $request->down_text;
        $publish_test = $request->publish_test;

        $insert = new MemoryBank();
        if ($request->hasFile('item_img')) {
            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $destinationPath = public_path() . '/assets/uploads/memory_background/';
            $file->move($destinationPath, $file_name);
            $insert->background = $file_name;
        }

        $total_questions = explode(',', $request->total_question);
        array_unshift($total_questions, "0");

        foreach ($total_questions as $key => $total_question) {
            if ($total_question != null) {
                $request_sub_question_data = 'sub_question_data_' . $total_question;
                $request_sub_correct_answer = 'sub_correct_answer_' . $total_question;

                $sub_question_data_explode = explode(',', $request->$request_sub_question_data);
                $sub_question_data[] = implode('||', $sub_question_data_explode);

                $sub_correct_answer_explode = explode(',', $request->$request_sub_correct_answer);
                sort($sub_correct_answer_explode);
                $sub_correct_answer[] = implode('||', $sub_correct_answer_explode);
            }
        }

        $sub_question = implode('~~', $sub_question_data);
        $sub_correct_answer = implode('~~', $sub_correct_answer);

        $insert->item_name = $question_name;
        $insert->item_level = $question_level;
        $insert->item_category = $question_category;
        $insert->top_text = $top_text;
        $insert->down_text = $down_text;
        $insert->sub_questions = $sub_question;
        $insert->sub_correct_answer = $sub_correct_answer;
        $insert->item_status = $publish_test;
        $insert->save();

        return ($publish_test);
    }

    public function editMemoryItem($id)
    {
        $item_levels = ItemLevel::get();
        $item_categories = ItemCategory::get();
        $memory_item = MemoryBank::find($id);
        return view('update_memory_item', compact('memory_item', 'item_levels', 'item_categories'));
    }

    public function updateMemoryItem(Request $request, $id)
    {
        $update = MemoryBank::find($id);

        $removed_questions = explode(',', $request->removed_question);

        $old_questions = explode('~~', $update->sub_questions);
        $old_correct_answers = explode('~~', $update->sub_correct_answer);
        if ($removed_questions[0] != '') {

            foreach ($removed_questions as $removed_question) {
                $removed_sub_questions[] = $old_questions[$removed_question];
                $removed_correct_answers[] = $old_correct_answers[$removed_question];
                $explode_sub_questions = explode('||', $old_questions[$removed_question]);
                foreach ($explode_sub_questions as $sub_questions) {
                    $file_path = public_path() . '/assets/uploads/memory_options/' . $sub_questions;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            }

            $old_sub_question = array_diff($old_questions, $removed_sub_questions);
            $old_sub_correct_answers = array_diff($old_correct_answers, $removed_correct_answers);
        }

        $question_name = $request->question_name;
        $question_level = $request->question_level;
        $question_category = $request->question_category;
        $top_text = $request->top_text;
        $down_text = $request->down_text;
        $publish_test = $request->publish_test;

        if ($request->hasFile('item_img')) {
            $full_path = public_path() . '/assets/uploads/memory_background/' . $update->background;
            if (file_exists($full_path)) {
                unlink($full_path);
            }

            $file = $request->file('item_img');
            $file_name = str_random(3) . '_' . $file->getClientOriginalName();
            $destinationPath = public_path() . '/assets/uploads/memory_background/';
            $file->move($destinationPath, $file_name);
            $update->background = $file_name;
        }

        $total_questions = explode(',', $request->total_question);

        if ($total_questions[0] != '') {
            foreach ($total_questions as $key => $total_question) {
                if ($total_question != null) {
                    $request_sub_question_data = 'sub_question_data_' . $total_question;
                    $request_sub_correct_answer = 'sub_correct_answer_' . $total_question;

                    $sub_question_data_explode = explode(',', $request->$request_sub_question_data);
                    $sub_question_data[] = implode('||', $sub_question_data_explode);

                    $sub_correct_answer_explode = explode(',', $request->$request_sub_correct_answer);
                    sort($sub_correct_answer_explode);
                    $sub_correct_answer[] = implode('||', $sub_correct_answer_explode);
                }
            }

            $sub_question = implode('~~', $sub_question_data);
            $sub_correct_answer = implode('~~', $sub_correct_answer);
        }

        if ($removed_questions[0] != '' && $total_questions[0] != '') {
            $merge_sub_questions = array_merge($old_sub_question, $sub_question_data);
            $merge_sub_correct_answer = array_merge($old_sub_correct_answers, [$sub_correct_answer]);
            $update_sub_questions = implode('~~', $merge_sub_questions);
            $update_sub_correct_answer = implode('~~', $merge_sub_correct_answer);
            $update->sub_questions = $update_sub_questions;
            $update->sub_correct_answer = $update_sub_correct_answer;
        } elseif ($removed_questions[0] != '') {
            $update_sub_questions = implode('~~', $old_sub_question);
            $update_sub_correct_answer = implode('~~', $old_sub_correct_answers);
            $update->sub_questions = $update_sub_questions;
            $update->sub_correct_answer = $update_sub_correct_answer;
        } elseif ($total_questions[0] != '') {
            $merge_sub_questions = array_merge($old_questions, $sub_question_data);
            $merge_sub_correct_answer = array_merge($old_correct_answers, [$sub_correct_answer]);
            $update_sub_questions = implode('~~', $merge_sub_questions);
            $update_sub_correct_answer = implode('~~', $merge_sub_correct_answer);
            $update->sub_questions = $update_sub_questions;
            $update->sub_correct_answer = $update_sub_correct_answer;
        }

        $update->item_name = $question_name;
        $update->item_level = $question_level;
        $update->item_category = $question_category;
        $update->top_text = $top_text;
        $update->down_text = $down_text;
        $update->item_status = $publish_test;
        $update->save();

        return ($publish_test);
    }

    public function destroyMemoryItem($id)
    {
        $delete = MemoryBank::find($id);
        $old_questions = explode('~~', $delete->sub_questions);

        foreach ($old_questions as $old_question) {
            $explode_sub_questions = explode('||', $old_question);
            foreach ($explode_sub_questions as $sub_questions) {
                $file_path = public_path() . '/assets/uploads/memory_options/' . $sub_questions;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
        }

        $delete->delete();
        return ('success');
    }



    // test configuration

    public function testConfigNavigation()
    {
        $config = TestConfiguration::get()->pluck(['test_for'])->toArray();
        if (!empty($config)) {
            $filteredConfigIds = array_unique($config);
            $test_list = TestList::whereIn('id', $filteredConfigIds)->get();
        } else {
            $test_list = [];
        }
        return view('test_config_navigation', compact('test_list'));
    }

     public function testConfigList()
    {
        $test_config_list = TestConfiguration::with('testFor')->latest()->paginate(20);
        return view('test_config_list', compact('test_config_list'));
    }


    public function testConfigurations($test_for)
    {
        $testData = TestList::find($test_for);
        $test_config_list = TestConfiguration::with('testFor')->where('test_for', $test_for)->paginate(20);
        return view('test_config_list1', compact('test_config_list', 'testData'));
    }

    public function testConfig()
    {
        return 'sdf';
        // $test_config = TestConfiguration::select('test_for')->get();
        // foreach ($test_config as $config) {
        //     $test_for[] = $config->test_for;
        // }

        // if (isset($test_for)) {
        //     dd($test_for);
            // $test_list = TestList::whereNotIn('id', $test_for)->get();
        // } else {
        //     dd('else');
            $test_list = TestList::get();
        // }

        $tests_for_static = DB::table('question_set')->join('test_lists', 'question_set.item_set_for', '=', 'test_lists.id')->pluck('test_lists.id', 'test_lists.name');
        $tests_for_random = DB::table('item_bank')->join('test_lists', 'item_bank.item_for', '=', 'test_lists.id')->pluck('test_lists.id', 'test_lists.name');

        return view('create_test_config', compact('test_list', 'tests_for_static', 'tests_for_random'));
    }

    public function testRedirect(Request $request)
    {
        Session::put('test_for', $request->test_for);
        Session::put('test_name', $request->test_name);
        Session::put('test_configuration_type', $request->test_configuration_type);
        Session::put('total_item', $request->total_item);

        return redirect('/create-test-configuration');
    }

    public function createTestConfig()
    {
        $test_for = Session::get('test_for');
        $test_name = Session::get('test_name');
        $test_configuration_type = Session::get('test_configuration_type');
        $total_item = Session::get('total_item');

        $test_list = TestList::get();
        $candidate_type = CandidateType::select('id', 'name')->get();
        $item_levels = ItemLevel::select('id', 'name')->get();

        if ($test_configuration_type == 1) {

            $counts = [];
            foreach ($item_levels as $level) {
                $count = ItemBank::Where('level', $level->id)->Where('item_for', $test_for)->WhereIn('item_status', [1,3])->count();
                if ($count != 0) {

                    $counts = $this->array_push_assoc($counts, $level->name, $count);
                }
            }
            return view('create_random_test', compact('test_for', 'test_list', 'candidate_type', 'test_name', 'counts', 'total_item'));
        } elseif ($test_configuration_type == 2) {
            $question_set = QuestionSet::Where('item_set_for', $test_for)->paginate(10);

            return view('create_static_test', compact('test_for', 'test_list', 'candidate_type', 'test_name', 'question_set', 'item_levels', 'total_item'));
        } else {

            return redirect('/new-test-configuration')->with('choose', 'Please fill this form.');
        }
    }

    public function storeTestConfig(Request $request)
    {
        $insert_data = new TestConfiguration();
        $insert_data->test_name = $request->test_name;
        $insert_data->test_for = $request->test_for;
        $insert_data->test_configuration_type = $request->test_type;
        $insert_data->candidate_type = $request->candidate_type;
        $insert_data->total_time = $request->total_time;
        $insert_data->pass_mark = $request->pass_mark;

        // random questions id generate

        if ($request->test_type == 1) {
            $total_items = $request->total_item;
            $item_levels = ItemLevel::select('id', 'name')->get();
            $counts = [];
            foreach ($item_levels as $key => $level) {
                $count = ItemBank::Where('item_for', $request->test_for)->WhereIn('item_status', [1,3])->Where('level', $level->id)->count();

                if ($count != 0) {
                    $counts = $this->array_push_assoc($counts, $level->name, $count);
                }
                if (isset($counts[$level->name])) {
                    $value =  $level->name;
                    $level_id = $level->id;
                    $total_request =  $request->$value;

                    if ($total_request != null) {
                        $question_levels[] = $level_id . '||' . $total_request;
                    }
                    $questions[] = ItemBank::select('id')->where('item_for', $request->test_for)->WhereIn('item_status', [1,3])->where('level', $level->id)->inRandomOrder()->limit($total_request)->pluck('id')->toArray();
                }
            }


            foreach (array_filter($questions) as $value) {
                $question_numbers[] = implode('||', $value);
            }
            $questions_id = implode('||', $question_numbers);
            $item_level = implode('~~', array_filter($question_levels));


            $insert_data->total_item = $total_items;
            $insert_data->item_level = $item_level;
            $insert_data->item_id = $questions_id;
            $insert_data->flag = 0;
        } elseif ($request->test_type == 2) {
            if ($request->data == 'random') {
                $random_set_id = QuestionSet::select('id')->where('item_set_for', $request->test_for)->inRandomOrder()->limit(1)->pluck('id')->toArray();
                $set_id = $random_set_id[0];
            } else {
                $set_id = $request->data;
            }

            $insert_data->flag = $request->flag;
            $insert_data->set_id = $set_id;
        }


        // $test_config = TestConfiguration::select('test_for')->get();
        // foreach ($test_config as $config) {
        //     $test_for[] = $config->test_for;
        // }

        // if (isset($test_for)) {
        //     if (in_array($request->test_for, $test_for)) {
        //         $test_list = TestList::where('id', $request->test_for)->select('name')->get()->toArray();
        //         $exists = ['exists', $test_list[0]['name']];

        //         return ($exists);
        //     } else {
        //         $insert_data->save();

        //         Session::forget('test_for');
        //         Session::forget('test_name');
        //         Session::forget('test_configuration_type');
        //         Session::forget('total_item');

        //         return ($request->test_for);
        //     }
        // } else {
            $insert_data->save();

            Session::forget('test_for');
            Session::forget('test_name');
            Session::forget('test_configuration_type');
            Session::forget('total_item');

            return ($request->test_for);
        // }
    }

    public function editTestConfig($id)
    {
        $test_config = TestConfiguration::find($id);
        $test_list = TestList::get();
        $test_for = $test_config->test_for;
        $candidate_type = CandidateType::select('id', 'name')->get();
        $item_levels = ItemLevel::select('id', 'name')->get();

        if ($test_config->test_configuration_type == 1) {
            $counts = [];
            foreach ($item_levels as $level) {
                $count = ItemBank::Where('level', $level->id)->Where('item_for', $test_config->test_for)->WhereIn('item_status', [1,3])->count();
                if ($count != 0) {

                    $counts = $this->array_push_assoc($counts, $level->name, $count);
                }
            }
            return view('edit_random_test', compact('test_for', 'test_list', 'candidate_type', 'counts', 'test_config'));
        } elseif ($test_config->test_configuration_type == 2) {
            $question_set = QuestionSet::Where('item_set_for', $test_config->test_for)->paginate(10);
            return view('edit_static_test', compact('test_for', 'test_list', 'candidate_type', 'question_set', 'item_levels', 'test_config'));
        }
    }

    public function updateTestConfig(Request $request, $id)
    {
        $update = TestConfiguration::find($id);
        $update->test_name = $request->test_name;
        $update->candidate_type = $request->candidate_type;
        $update->total_time = $request->total_time;
        $update->pass_mark = $request->pass_mark;

        // random questions id generate

        if ($update->test_configuration_type == 1) {
            $total_items = $request->total_item;
            $item_levels = ItemLevel::select('id', 'name')->get();
            $counts = [];
            foreach ($item_levels as $key => $level) {
                $count = ItemBank::Where('item_for', $update->test_for)->WhereIn('item_status', [1,3])->Where('level', $level->id)->count();

                if ($count != 0) {
                    $counts = $this->array_push_assoc($counts, $level->name, $count);
                }
                if (isset($counts[$level->name])) {
                    $value =  $level->name;
                    $level_id = $level->id;
                    $total_request =  $request->$value;

                    if ($total_request != null) {
                        $question_levels[] = $level_id . '||' . $total_request;
                    }
                    $questions[] = ItemBank::select('id')->where('item_for', $update->test_for)->WhereIn('item_status', [1,3])->where('level', $level->id)->inRandomOrder()->limit($total_request)->pluck('id')->toArray();
                }
            }

            foreach (array_filter($questions) as $value) {
                $question_numbers[] = implode('||', $value);
            }

            if (isset($question_numbers)) {
                $questions_id = implode('||', $question_numbers);
                $item_level = implode('~~', array_filter($question_levels));
                $update->total_item = $total_items;
                $update->item_level = $item_level;
                $update->item_id = $questions_id;
            }

            $update->flag = 0;
        } elseif ($update->test_configuration_type == 2) {
            if ($request->data == 'random') {
                $random_set_id = QuestionSet::select('id')->where('item_set_for', $update->test_for)->inRandomOrder()->limit(1)->pluck('id')->toArray();
                $set_id = $random_set_id[0];
            } else {
                $set_id = $request->data;
            }

            $update->flag = $request->flag;
            $update->set_id = $set_id;
        }

        $update->save();

        return ($update->test_for);
    }

    public function destroyTestConfig($id)
    {
        TestConfiguration::find($id)->delete();
        return ('success');
    }

    public function testGroup()
    {
        $test_groups = TestGroups::get();
        foreach ($test_groups as $key => $value) {
            $explode_test_config_id[] = explode('||', $value->test_config_id);
        }
        if (isset($explode_test_config_id)) {
            $merged_test_config_id = array_merge(...$explode_test_config_id);
            $unique_test_config_id = array_unique($merged_test_config_id);
        } else {
            $unique_test_config_id = [''];
        }


        $config = TestConfiguration::get();
        foreach ($config as $value) {
            $test_list[] = TestList::whereNotIn('id', $unique_test_config_id)->where('id', $value->test_for)->get();
        }

        $test_list_show = TestList::get();
        $count = TestGroups::get()->count();

        return view('test_group', compact('test_groups', 'test_list', 'test_list_show', 'count'));
    }

    public function storeTestGroup(Request $request)
    {
        $insert = new TestGroups();
        $insert->groups = $request->test_group;
        $test_config_id = implode('||', $request->test_config);
        $insert->test_config_id = $test_config_id;
        $insert->save();
        return ('success');
    }

    public function destroyTestGroup($id)
    {
        TestGroups::find($id)->delete();
        return ('success');
    }

    public function boardConfiguration()
    {
        $test_groups = TestGroups::paginate(10);
        $test_list = TestList::get();
        $test_config = TestConfiguration::get();
        $sets = QuestionSet::get();
        return view('board_config', compact('test_groups', 'test_list', 'test_config', 'sets'));
    }

    public static function testInfo($id){
        $testInfo = TestConfiguration::find($id);
        return $testInfo;
    }

    public static function totalQuestionSetItems($set_id){
        $totalQuestionSetItems = explode('||', QuestionSet::find($set_id)->questions_id);
        return count($totalQuestionSetItems);
    }
}
