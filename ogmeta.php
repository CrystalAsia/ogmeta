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
        if (JRequest::getVar('view') == 'article') {
            $document = JFactory::getDocument();

            $articleTitle = JTable::getInstance("content");
            $articleTitle->load(JRequest::getInt("id"));
            $introText = substr(strip_tags($articleTitle->get("introtext")), 0,250) . "...";

            $config = JFactory::getConfig();
            $u = JFactory::getURI();

            $document->addCustomTag('<meta prefix="og: http://ogp.me/ns#" property="og:title" content="' . $articleTitle->get("title") . '" />');
	    $document->addCustomTag('<meta prefix="og: http://ogp.me/ns#" property="og:url" content="' . $u->toString() . '" />');
	    $document->addCustomTag('<meta prefix="og: http://ogp.me/ns#" property="og:description" content="' . $introText . '" />');
	    $document->addCustomTag('<meta prefix="og: http://ogp.me/ns#" property="og:site_name" content="' . $config->get('sitename') . '" />');

	    $document->addCustomTag('<meta prefix="og: http://ogp.me/ns#" property="article:publisher" content="' . JURI::root() . '" />');

            $ogImage = $this->params->get('ogimage');
            if ($ogImage != '') {
                $document->addCustomTag('<meta prefix="og: http://ogp.me/ns#" property="og:image" content="' . $ogImage . '" />');
            }

            $document->addCustomTag('<meta prefix="og: http://ogp.me/ns#" property="og:type" content="article" />');
        }
    }
}
