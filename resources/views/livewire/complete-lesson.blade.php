<div class="text-center">
    <div wire:loading class="spinner-border text-primary" role="status"></div>
    <button wire:loading.remove wire:click="completeLesson({{$lessonId, $moduleId}})" class="btn w-100 w-md-50 btn-primary" type="submit">Mark as complete</button>
</div>
