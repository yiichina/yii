<?php if($protected && !$class->protectedPropertyCount || !$protected && !$class->publicPropertyCount) return; ?>

<div class="summary docProperty">
<h2><?php echo $protected ? '受保护的属性' : '公共属性'; ?></h2>

<p><a href="#" class="toggle">隐藏继承的属性</a></p>

<table class="summaryTable table table-striped table-bordered">
<colgroup>
	<col class="col-property" />
	<col class="col-type" />
	<col class="col-description" />
	<col class="col-defined" />
</colgroup>
<tr>
  <th>属性</th><th>类型</th><th>描述</th><th>被定义在</th>
</tr>
<?php foreach($class->properties as $property): ?>
<?php if($protected && $property->isProtected || !$protected && !$property->isProtected): ?>
<tr<?php echo $property->isInherited?' class="inherited"':''; ?> id="<?php echo $property->name; ?>">
  <td><?php echo $this->renderSubjectUrl($property->definedBy,$property->name); ?></td>
  <td><?php echo $this->renderTypeUrl($property->type); ?></td>
  <td><?php echo $property->introduction; ?></td>
  <td><?php echo $this->renderTypeUrl($property->definedBy); ?></td>
</tr>
<?php endif; ?>
<?php endforeach; ?>
</table>
</div>