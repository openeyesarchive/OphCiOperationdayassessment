
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<table class="subtleWhite normalText">
	<tbody>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('anaesthetic_given_by_nurse'))?></td>
			<td><span class="big"><?php $element->anaesthetic_given_by_nurse ? 'Yes' : 'No'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('nurse_id'))?></td>
			<td><span class="big"><?php echo $element->nurse ? $element->nurse->first_name : 'None'?></span></td>
		</tr>
		<tr>
			<td width="30%"><?php echo CHtml::encode($element->getAttributeLabel('anaesthetic_id'))?></td>
			<td><span class="big"><?php echo $element->anaesthetic ? $element->anaesthetic->name : 'None'?></span></td>
		</tr>
	</tbody>
</table>
