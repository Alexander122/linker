<?php

namespace core\Observers;

class ModelObserver implements \SplObserver
{
    private $models = [];
    
    public function update(\SplSubject $subject)
    {
        $this->models[] = $subject;
        $subject->beforeSave();
        // $subject->save();
        $subject->afterSave();
    }
}
