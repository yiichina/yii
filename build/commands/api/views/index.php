<h1>所有包</h1>

<table class="summaryTable table table-bordered table-striped">
<tr>
  <th>包</th><th>类</th><th>描述</th>
</tr>
<?php foreach($this->packages as $package=>$classes): ?>
<?php foreach($classes as $i=>$class): ?>
<tr>
  <?php if(!$i): ?>
  <td rowspan="<?php echo count($classes); ?>"><?php echo '<a name="'.$package.'"></a>' . $package; ?></td>
  <?php endif; ?>
  <td><?php echo '{{'.$class.'|'.$class.'}}'; ?></td>
  <td><?php echo $this->classes[$class]->introduction; ?></td>
</tr>
<?php endforeach; ?>
<?php endforeach; ?>
</table>
