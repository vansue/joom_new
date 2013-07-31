<?php
/**
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
jimport('joomla.plugin.plugin');

/**
 * Đây là class plugin đăng ký tùy chỉnh. Nó chỉ ra rằng người dùng check vào hộp 
 * chỉ ra rằng người dùng đồng ý với các điều khoản dịch vụ và đủ tuổi để dùng site
 *
 * @package		Joomla.Plugin
 * @subpackage	User.myregistration
 */
class plgUserMyRegistration extends JPlugin
{
	/**
	* Phương thức xử lý sự kiện "onUserBeforeSave" và xác định xem các input đã đủ 
	* để cho phép save xảy ra không. Đặc biệt chúng ta kiểm tra để chắc chắn rằng đây
	* là lưu 1 người dùng mới (đăng ký người dùng), và người dùng đã check các box
	* chỉ ra rằng họ đồng ý với các điều khoản dịch vụ và đủ tuổi để dùng site.
	*
	* @param 	array 	$previousData	Dữ liệu đã được lưu cho người dùng
	* @param 	bool 	$isNew 			True nếu người dùng được lưu là mới
	* @param 	array 	$futureData 	Dữ liệu mới để lưu cho người dùng
	* 
	* @return 	bool	True để cho phép quá trình lưu tiếp tục, false để dừng quá trình này lại
	*
	* @since 	1.0 
	*/
	function onUserBeforeSave($previousData, $isNew, $futureData)
	{
		// Nếu chúng ta không lưu một người dùng mới (đăng ký), hoặc nếu chúng ta không
		// ở front end của site, thì quá trình lưu xảy ra không bị gián đoạn.
		if (!$isNew || !JFactory::getApplication()->isSite()) {
			return true;
		}

		// Load file ngôn ngữ cho plugin
		$this->loadLanguage();
		$result = true;

		// Kiểm tra rằng checkbox "Tôi đồng ý với điều khoản dịch vụ của site." đã được check.
		if (!JRequest::getBool('tos_agree')) {
			JError::raiseWarning(1000, JText::_('PLG_USER_MYREGISTRATION_TOS_AGREE_REQUIRED'));
			$result = false;
		}

		// Kiểm tra rằng checkbox "Tôi đủ 18 tuổi." đã được check.
		if (!JRequest::getBool('old_enough')) {
			JError::raiseWarning(1000, JText::_('PLG_USER_MYREGISTRATION_OLD_ENOUGH_REQUIRED'));
			$result = false;
		}
		return $result;
	}
}