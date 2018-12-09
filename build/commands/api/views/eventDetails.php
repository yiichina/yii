<?php if(!$class->nativePropertyCount) return; ?>
<h2>事件详情</h2>
<?php foreach($class->events as $event): ?>
<?php if($event->isInherited) continue; ?>
<div class="detailHeader" id="<?php echo $event->name.'-detail'; ?>">
<?php echo $event->name; ?>
<span class="detailHeaderTag">
event
<?php if(!empty($event->since)): ?>
（自版本 v<?php echo $event->since; ?> 可用）
<?php endif; ?>
</span>
</div>

<div class="signature">
<?php echo $event->trigger->signature; ?>
</div>

<p>
<?php echo $event->description; ?>
</p>

<?php $this->renderPartial('seeAlso',array('object'=>$event)); ?>

<?php endforeach; ?>
