<?php if($protected && !$class->protectedMethodCount || !$protected && !$class->publicMethodCount) return; ?>

<div class="summary">
<h2><?php echo $protected ? '受保护的方法' : '公共方法'; ?></h2>
<p>
<a href="#" class="toggle">隐藏继承的方法</a>
</p>
<table class="summaryTable table table-striped table-bordered table-hover">
<tr>
  <th>方法</th><th>描述</th><th>被定义在</th>
</tr>
<?php foreach($class->methods as $method): ?>
<?php if($protected && $method->isProtected || !$protected && !$method->isProtected): ?>
<tr<?php echo $method->isInherited?' class="inherited"':''; ?> id="<?php echo $method->name; ?>">
  <td><?php echo $this->renderSubjectUrl($method->definedBy,$method->name,$method->name.'()'); ?></td>
  <td><?php echo $method->introduction; ?></td>
  <td><?php echo $this->renderTypeUrl($method->definedBy); ?></td>
</tr>
<?php endif; ?>
<?php endforeach; ?>
</table>
</div>