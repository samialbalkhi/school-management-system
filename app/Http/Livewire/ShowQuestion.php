<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use Livewire\Component;
use App\Models\Question;

class ShowQuestion extends Component
{
    public $quizze_id,
        $data,
        $student_id,
        $counter = 0,
        $questioncount = 0;
    public function render()
    {
       
        $this->data = Question::where('quizze_id', $this->quizze_id)->get();
        $this->questioncount=$this->data->count();
        return view('livewire.show-question', ['data']);
    }

    public function nextQuestion($question_id, $score, $answer, $correct_answer)
    {
        $stuDegree = Degree::where('student_id', $this->student_id)
            ->where('quizze_id', $this->quizze_id)
            ->first();

        if ($stuDegree == null) {
            $inputs = [
                'student_id' => $this->student_id,
                'quizze_id' => $this->quizze_id,
                'question_id' => $question_id,
                'score' => 0,
                'date' => date('Y-m-d'),
            ];
        }

        if (strcmp(trim($answer), trim($correct_answer)) === 0) {
            $inputs['score'] = $score += $score;
        }
        Degree::create($inputs);

        if ($this->counter < $this->questioncount - 1) {
            $this->counter++;
        } else {
            toastr()->success('تم إجراء الاختبار بنجاح');
            return redirect('StudentExams');
        }
    }
}
