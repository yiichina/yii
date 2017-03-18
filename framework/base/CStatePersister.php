<?php
/**
 * This file contains classes implementing security manager feature.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright 2008-2013 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CStatePersister 实现一个基于文件的持久数据存储。 
 *
 * 它可以用来保持多个请求或会话的数据。 
 *
 * 默认，CStatePersister 存储数据在一个名字叫 'state.bin' 文件中
 * 它位于应用程序指定的 {@link CApplication::getRuntimePath runtime path} 下。
 * 你可以通过设置 {@link stateFile} 属性来改变它的位置。
 *
 * To retrieve the data from CStatePersister, call {@link load()}. To save the data,
 * call {@link save()}.
 *
 * 持久数据，会话和缓存之间的比较如下: 
 * <ul>
 * <li>session: 单个用户的会话持久数据。</li>
 * <li>state persister: 所有请求的/会话的持久数据（例如，点击统计）。</li>
 * <li>cache: 不稳定并快速的存诸。它可的使用介于会话和持久数据之间。</li>
 * </ul>
 *
 * Since server resource is often limited, be cautious if you plan to use CStatePersister
 * to store large amount of data. You should also consider using database-based persister
 * to improve the throughput.
 *
 * CStatePersister is a core application component used to store global application state.
 * It may be accessed via {@link CApplication::getStatePersister()}.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @package system.base
 * @since 1.0
 */
class CStatePersister extends CApplicationComponent implements IStatePersister
{
	/**
	 * @var string the file path storing the state data. Make sure the directory containing
	 * the file exists and is writable by the Web server process. If using relative path, also
	 * make sure the path is correct.
	 */
	public $stateFile;
	/**
	 * @var string the ID of the cache application component that is used to cache the state values.
	 * Defaults to 'cache' which refers to the primary cache application component.
	 * Set this property to false if you want to disable caching state values.
	 */
	public $cacheID='cache';

	/**
	 * 初始化这个组件。
	 * 这个方法重载了父类的实现，
	 * 添加了一个 {@link stateFile} 的有效值。
	 */
	public function init()
	{
		parent::init();
		if($this->stateFile===null)
			$this->stateFile=Yii::app()->getRuntimePath().DIRECTORY_SEPARATOR.'state.bin';
		$dir=dirname($this->stateFile);
		if(!is_dir($dir) || !is_writable($dir))
			throw new CException(Yii::t('yii','Unable to create application state file "{file}". Make sure the directory containing the file exists and is writable by the Web server process.',
				array('{file}'=>$this->stateFile)));
	}

	/**
	 * 从持久存储加载状态数据。
	 * @return mixed 状态数据。如果状态数据不可用返回 null。
	 */
	public function load()
	{
		$stateFile=$this->stateFile;
		if($this->cacheID!==false && ($cache=Yii::app()->getComponent($this->cacheID))!==null)
		{
			$cacheKey='Yii.CStatePersister.'.$stateFile;
			if(($value=$cache->get($cacheKey))!==false)
				return unserialize($value);
			else
			{
				if(($content=$this->getContent($stateFile))!==false)
				{
					$unserialized_content=unserialize($content);
					// If it can't be unserialized, don't cache it:
					if ($unserialized_content!==false || $content=="") 
						$cache->set($cacheKey,$content,0,new CFileCacheDependency($stateFile));
					return $unserialized_content;
				}
				else
					return null;
			}
		}
		elseif(($content=$this->getContent($stateFile))!==false)
			return unserialize($content);
		else
			return null;
	}
	
	/**
	 * Loads content from file using a shared lock to avoid data corruption when reading
	 * the file while it is being written by save()
	 *
	 * @param string $filename file name
	 * @return bool|string file contents
	 * @since 1.1.17
	 */
	protected function getContent($filename)
	{
		$file=@fopen($filename,"r");
		if($file && flock($file,LOCK_SH))
		{
			$contents=@file_get_contents($filename);
			flock($file,LOCK_UN);
			fclose($file);
			return $contents;
		}
		return false;
	}
	
	/**
	 * Saves application state in persistent storage.
	 * @param mixed $state state data (must be serializable).
	 */
	public function save($state)
	{
		file_put_contents($this->stateFile,serialize($state),LOCK_EX);
	}
}
