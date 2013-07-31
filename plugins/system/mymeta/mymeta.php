<?php
/**
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
jimport('joomla.plugin.plugin');

/**
 * Ví dụ System Plugin
 *
 * @package		Joomla.Plugin
 * @subpackage	System.mymeta
 */
class plgSystemMyMeta extends JPlugin
{
	function onBeforeCompileHead()
	{
		//Nếu có parameter 'revised'
		if ($this->params->get('revised')) {
			// Khởi tạo document object
			$document = JFactory::getDocument();
			// Lấy toàn bộ dữ liệu trong head lưu vào $headData là một array
			$headData = $document->getHeadData();
			// Thêm revised vào array $headData
			$headData['metaTags']['standard']['revised'] = $this->params->get('revised');
			// Ghi lại array mới vào $document
			$document->setHeadData($headData);
		}
	}
}
