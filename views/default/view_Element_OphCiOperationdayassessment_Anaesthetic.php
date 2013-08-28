
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('anaesthetic_given_by_nurse'))?></td>
			<td><span class="big"><?php echo $element->anaesthetic_given_by_nurse ? 'Yes' : 'No'?></span></td>
		</tr>
		<?php if ($element->anaesthetic_given_by_nurse) {?>
			<tr>
				<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('nurse_id'))?></td>
				<td><span class="big"><?php echo $element->nurse ? $element->nurse->first_name : 'None'?></span></td>
			</tr>
			<tr>
				<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('anaesthetic_agents'))?></td>
				<td>
					<span class="big">
						<?php foreach ($element->anaesthetic_agents as $agent) {
							echo $agent->anaesthetic->name?><br/>
						<?php }?>
					</span>
				</td>
			</tr>
			<tr>
				<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('nurse_witnessed_anaesthetic'))?></td>
				<td><span class="big"><?php echo $element->nurse_witnessed_anaesthetic ? 'Yes' : 'No'?></span></td>
			</tr>
			<tr>
				<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('completed_cataract_nurse_id'))?></td>
				<td><span class="big"><?php echo $element->completed_cataract_nurse ? $element->completed_cataract_nurse->name : 'None'?></span></td>
			</tr>
		<?php }?>
	</tbody>
</table>
