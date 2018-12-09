<table class="summaryTable table table-striped table-bordered">
<tr>
  <th>包</th>
  <td><?php echo '{{index::'.$class->package.'|'.$class->package.'}}'; ?></td>
</tr>
<tr>
  <th>继承</th>
  <td><?php echo $this->renderInheritance($class); ?></td>
</tr>
<?php if(!empty($class->interfaces)): ?>
<tr>
  <th>实现</th>
  <td><?php echo $this->renderImplements($class); ?></td>
</tr>
<?php endif; ?>
<?php if(!empty($class->subclasses)): ?>
<tr>
  <th>子类</th>
  <td><?php echo $this->renderSubclasses($class); ?></td>
</tr>
<?php endif; ?>
<?php if(!empty($class->since)): ?>
<tr>
  <th>可用自</th>
  <td><?php echo $class->since; ?></td>
</tr>
<?php endif; ?>
<?php if(!empty($class->version)): ?>
<tr>
  <th>版本</th>
  <td><?php echo $class->version; ?></td>
</tr>
<?php endif; ?>
</table>

<div id="classDescription">
<?php echo $class->description; ?>
</div>