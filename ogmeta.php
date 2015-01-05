<?
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgContentOgMeta extends JPlugin
{

    public function plgContentOgMeta(&$subject, $params)
    {
        parent::__construct($subject, $params);
    }

    public function onContentBeforeDisplay($context, &$article, &$params)
    {
        global $mainframe;
        if (JRequest::getVar('view') != 'featured') {
            $document = JFactory::getDocument();

            $articleTitle = JTable::getInstance("content");
            $articleTitle->load(JRequest::getInt("id"));

            $config = JFactory::getConfig();
            $u = JFactory::getURI();

            $document->addCustomTag('<meta property="og:title" content="' . $articleTitle->get("title") . '" />');
            $document->addCustomTag('<meta property="og:url" content="' . $u->toString() . '" />');
            $document->addCustomTag('<meta property="og:site_name" content="' . $config->get('sitename') . '" />');

            $ogImage = $this->params->get('ogimage');
            if ($ogImage != '') {
                $document->addCustomTag('<meta property="og:image" content="' . $ogImage . '" />');
            }

            if ($ogDesc != '') {
                $document->addCustomTag('<meta property="og:description" content="' . $ogDesc . '" />');
            }

            $document->addCustomTag('<meta property="og:type" content="article" />');
        }
    }
}
