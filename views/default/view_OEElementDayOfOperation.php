
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<div class="view">

			<div class="view">
				<b><?php  echo CHtml::encode($element->getAttributeLabel('medical_history')); ?>:</b>
				<?php  echo $element->medical_history ? 'Yes' : 'No' ?>				<br />
			</div>
			
					<div class="view">
				<b><?php  echo CHtml::encode($element->getAttributeLabel('inr_level')); ?>:</b>
				<?php  echo $element->inr_level ?>				<br />
			</div>
			
					<div class="view">
				<b><?php  echo CHtml::encode($element->getAttributeLabel('preop_checklist_completed')); ?>:</b>
				<?php  echo $element->preop_checklist_completed ? 'Yes' : 'No' ?>				<br />
			</div>
			
					<div class="view">
				<b><?php  echo CHtml::encode($element->getAttributeLabel('cjd_checklist_completed')); ?>:</b>
				<?php  echo $element->cjd_checklist_completed ? 'Yes' : 'No' ?>				<br />
			</div>
			
		</div>

