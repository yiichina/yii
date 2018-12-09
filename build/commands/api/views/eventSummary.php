<?php if(empty($class->events)) return; ?>

<div class="summary docEvent">
<h2>事件</h2>

<p><a href="#" class="toggle">隐藏继承的事件</a></p>

<table class="summaryTable table table-striped table-bordered">
<colgroup>
	<col class="col-event" />
	<col class="col-description" />
	<col class="col-defined" />
</colgroup>
<tr>
  <th>事件</th><th>描述</th><th>被定义在</th>
</tr>
<?php foreach($class->events as $event): ?>
<tr<?php echo $event->isInherited?' class="inherited"':''; ?> id="<?php echo $event->name; ?>">
  <td><?php echo $this->renderSubjectUrl($event->definedBy,$event->name); ?></td>
  <td><?php echo $event->introduction; ?></td>
  <td><?php echo $this->renderTypeUrl($event->definedBy); ?></td>
</tr>
<?php endforeach; ?>
</table>
</div>