<?php $this->beginContent('//patient/event_container');
$this->moduleNameCssClass.=" highlight-fields"; ?>

<?php  $this->renderDefaultElements($this->action->id); ?>	<?php  $this->renderOptionalElements($this->action->id); ?>

<?php $this->endContent() ;?>
