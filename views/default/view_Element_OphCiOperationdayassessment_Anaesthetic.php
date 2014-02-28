<div class="element-data">
	<div class="data-row row">
		<div class="large-4 column">
			<div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('anaesthetic_given_by_nurse'))?></div>
		</div>
		<div class="large-8 column">
			<div class="data-value"><?php echo $element->anaesthetic_given_by_nurse ? 'Yes' : 'No'?></div>
		</div>
	</div>
	<?php if ($element->anaesthetic_given_by_nurse) {?>
		<div class="data-row row">
			<div class="large-4 column">
				<div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('nurse_id'))?></div>
			</div>
			<div class="large-8 column">
				<div class="data-value"><?php echo $element->nurse ? $element->nurse->first_name : 'None'?></div>
			</div>
		</div>
		<div class="data-row row">
			<div class="large-4 column">
				<div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('anaesthetic_agents'))?></div>
			</div>
			<div class="large-8 column">
				<div class="data-value">
					<?php foreach ($element->anaesthetic_agents as $agent) {
						echo $agent->anaesthetic->name?><br/>
					<?php }?>
				</div>
			</div>
		</div>
		<div class="data-row row">
			<div class="large-4 column">
				<div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('nurse_witnessed_anaesthetic'))?></div>
			</div>
			<div class="large-8 column">
				<div class="data-value"><?php echo $element->nurse_witnessed_anaesthetic ? 'Yes' : 'No'?></div>
			</div>
		</div>
		<div class="data-row row">
			<div class="large-4 column">
				<div class="data-label"><?php echo CHtml::encode($element->getAttributeLabel('completed_cataract_nurse_id'))?></div>
			</div>
			<div class="large-8 column">
				<div class="data-value"><?php echo $element->completed_cataract_nurse ? $element->completed_cataract_nurse->name : 'None'?></div>
			</div>
		</div>
	<?php }?>
</div>
