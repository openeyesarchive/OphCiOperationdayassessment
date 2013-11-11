<?php $this->beginContent('//patient/event_container');
$this->moduleNameCssClass.=" highlight-fields";?>
<h2 class="event-title"><?php echo $this->event_type->name ?></h2>

<?php  $this->renderDefaultElements($this->action->id); ?>	<?php  $this->renderOptionalElements($this->action->id); ?>

<?php $this->endContent() ;?>
