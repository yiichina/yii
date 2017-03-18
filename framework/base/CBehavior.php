<?php
/**
 * CBehavior class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CBehavior 是所有行为类的基类。
 *
 * @property CComponent $owner 此行为被附加的所有者组件。
 * @property boolean $enabled 此行为是否被启用。
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.base
 */
class CBehavior extends CComponent implements IBehavior
{
	private $_enabled=false;
	private $_owner;

	/**
	 * 声明事件和相应事件的处理方法。
	 * The events are defined by the {@link owner} component, while the handler
	 * methods by the behavior class. The handlers will be attached to the corresponding
	 * events when the behavior is attached to the {@link owner} component; and they
	 * will be detached from the events when the behavior is detached from the component.
	 * Make sure you've declared handler method as public.
	 * @return array events (array keys) and the corresponding event handler methods (array values).
	 */
	public function events()
	{
		return array();
	}

	/**
	 * 对组件附加行为对象。
	 * The default implementation will set the {@link owner} property
	 * and attach event handlers as declared in {@link events}.
	 * This method will also set {@link enabled} to true.
	 * Make sure you've declared handler as public and call the parent implementation if you override this method.
	 * @param CComponent $owner the component that this behavior is to be attached to.
	 */
	public function attach($owner)
	{
		$this->_enabled=true;
		$this->_owner=$owner;
		$this->_attachEventHandlers();
	}

	/**
	 * 从组件中分离行为对象。
	 * The default implementation will unset the {@link owner} property
	 * and detach event handlers declared in {@link events}.
	 * This method will also set {@link enabled} to false.
	 * Make sure you call the parent implementation if you override this method.
	 * @param CComponent $owner the component that this behavior is to be detached from.
	 */
	public function detach($owner)
	{
		foreach($this->events() as $event=>$handler)
			$owner->detachEventHandler($event,array($this,$handler));
		$this->_owner=null;
		$this->_enabled=false;
	}

	/**
	 * @return CComponent 此行为被连接到该所有者的组件。
	 */
	public function getOwner()
	{
		return $this->_owner;
	}

	/**
	 * @return boolean 行为是否被启用。
	 */
	public function getEnabled()
	{
		return $this->_enabled;
	}

	/**
	 * @param boolean $value 行为是否被启用。
	 */
	public function setEnabled($value)
	{
		$value=(bool)$value;
		if($this->_enabled!=$value && $this->_owner)
		{
			if($value)
				$this->_attachEventHandlers();
			else
			{
				foreach($this->events() as $event=>$handler)
					$this->_owner->detachEventHandler($event,array($this,$handler));
			}
		}
		$this->_enabled=$value;
	}

	private function _attachEventHandlers()
	{
		$class=new ReflectionClass($this);
		foreach($this->events() as $event=>$handler)
		{
			if($class->getMethod($handler)->isPublic())
				$this->_owner->attachEventHandler($event,array($this,$handler));
		}
	}
}
