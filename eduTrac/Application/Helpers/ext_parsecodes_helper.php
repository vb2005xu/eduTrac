<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 * eduTrac Parsecodes Helper
 *
 * PHP 5.4+
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * @copyright (c) 2013 7 Media Web Solutions, LLC
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @link        http://www.7mediaws.org/
 * @since       4.2.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */
	
use \eduTrac\Classes\Libraries\Hooks;
	
	$parsecode_tags = array();

	function clean_pre($matches) {
		if ( is_array($matches) )
			$text = $matches[1] . $matches[2] . "</pre>";
		else
			$text = $matches;
	
		$text = str_replace('<br />', '', $text);
		$text = str_replace('<p>', "\n", $text);
		$text = str_replace('</p>', '', $text);
	
		return $text;
	}
	
	if(!function_exists('add_parsecode')) {
		function add_parsecode($tag, $func) {
			global $parsecode_tags;
	
			if ( is_callable($func) )
				$parsecode_tags[$tag] = $func;
		}
	}

	/**
	 * Removes hook for parsecode.
	 *
	 * @since 1.0
	 * @uses $parsecode_tags
	 *
	 * @param string $tag parsecode tag to remove hook for.
	 */
	function remove_parsecode($tag) {
		global $parsecode_tags;

		unset($parsecode_tags[$tag]);
	}

	/**
	 * Clear all parsecodes.
	 *
	 * This function is simple, it clears all of the parsecode tags by replacing the
	 * parsecodes global by a empty array. This is actually a very efficient method
	 * for removing all parsecodes.
	 *
	 * @since 1.0
	 * @uses $parsecode_tags
	 */
	function remove_all_parsecodes() {
		global $parsecode_tags;

		$parsecode_tags = array();
	}

	/**
	 * Search content for parsecodes and filter parsecodes through their hooks.
	 *
	 * If there are no parsecode tags defined, then the content will be returned
	 * without any filtering. This might cause issues when plugins are disabled but
	 * the parsecode will still show up in the post or content.
	 *
	 * @since 1.0
	 * @uses $parsecode_tags
	 * @uses get_parsecode_regex() Gets the search pattern for searching parsecodes.
	 *
	 * @param string $content Content to search for parsecodes
	 * @return string Content with parsecodes filtered out.
	 */
	function do_parsecode($content) {
		global $parsecode_tags;

		if (empty($parsecode_tags) || !is_array($parsecode_tags))
			return $content;

		$pattern = get_parsecode_regex();
		return preg_replace_callback( "/$pattern/s", 'do_parsecode_tag', $content );
	}

	/**
	 * Retrieve the parsecode regular expression for searching.
	 *
	 * The regular expression combines the parsecode tags in the regular expression
	 * in a regex class.
	 *
	 * The regular expression contains 6 different sub matches to help with parsing.
	 *
	 * 1 - An extra [ to allow for escaping parsecodes with double [[]]
	 * 2 - The parsecode name
	 * 3 - The parsecode argument list
	 * 4 - The self closing /
	 * 5 - The content of a parsecode when it wraps some content.
	 * 6 - An extra ] to allow for escaping parsecodes with double [[]]
	 *
	 * @since 1.0
	 * @uses $parsecode_tags
	 *
	 * @return string The parsecode search regular expression
	 */
	function get_parsecode_regex() {
		global $parsecode_tags;
		$tagnames = array_keys($parsecode_tags);
		$tagregexp = join( '|', array_map('preg_quote', $tagnames) );

		// WARNING! Do not change this regex without changing do_parsecode_tag() and strip_parsecode_tag()
		return
		  		'\\['                              // Opening bracket
			. '(\\[?)'                           // 1: Optional second opening bracket for escaping parsecodes: [[tag]]
			. "($tagregexp)"                     // 2: parsecode name
			. '\\b'                              // Word boundary
			. '('                                // 3: Unroll the loop: Inside the opening parsecode tag
			.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			.     '(?:'
			.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
			.     ')*?'
			. ')'
			. '(?:'
			.     '(\\/)'                        // 4: Self closing tag ...
			.     '\\]'                          // ... and closing bracket
			. '|'
			.     '\\]'                          // Closing bracket
			.     '(?:'
			.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing parsecode tags
			.             '[^\\[]*+'             // Not an opening bracket
			.             '(?:'
			.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing parsecode tag
			.                 '[^\\[]*+'         // Not an opening bracket
			.             ')*+'
			.         ')'
			.         '\\[\\/\\2\\]'             // Closing parsecode tag
			.     ')?'
			. ')'
			. '(\\]?)';                          // 6: Optional second closing brocket for escaping parsecodes: [[tag]]
	}

	/**
	 * Regular Expression callable for do_parsecode() for calling parsecode hook.
	 * @see get_parsecode_regex for details of the match array contents.
	 *
	 * @since 1.0
	 * @access private
	 * @uses $parsecode_tags
	 *
	 * @param array $m Regular expression match array
	 * @return mixed False on failure.
	 */
	function do_parsecode_tag( $m ) {
		global $parsecode_tags;

		// allow [[foo]] syntax for escaping a tag
		if ( $m[1] == '[' && $m[6] == ']' ) {
			return substr($m[0], 1, -1);
		}

		$tag = $m[2];
		$attr = parsecode_parse_atts( $m[3] );

		if ( isset( $m[5] ) ) {
			// enclosing tag - extra parameter
			return $m[1] . call_user_func( $parsecode_tags[$tag], $attr, $m[5], $tag ) . $m[6];
		} else {
			// self-closing tag
			return $m[1] . call_user_func( $parsecode_tags[$tag], $attr, NULL,  $tag ) . $m[6];
		}
	}

	/**
	 * Retrieve all attributes from the parsecodes tag.
	 *
	 * The attributes list has the attribute name as the key and the value of the
	 * attribute as the value in the key/value pair. This allows for easier
	 * retrieval of the attributes, since all attributes have to be known.
	 *
	 * @since 1.0
	 *
	 * @param string $text
	 * @return array List of attributes and their value.
	 */
	function parsecode_parse_atts($text) {
		$atts = array();
		$pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
		$text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
		if ( preg_match_all($pattern, $text, $match, PREG_SET_ORDER) ) {
			foreach ($match as $m) {
				if (!empty($m[1]))
					$atts[strtolower($m[1])] = stripcslashes($m[2]);
				elseif (!empty($m[3]))
					$atts[strtolower($m[3])] = stripcslashes($m[4]);
				elseif (!empty($m[5]))
					$atts[strtolower($m[5])] = stripcslashes($m[6]);
				elseif (isset($m[7]) and strlen($m[7]))
					$atts[] = stripcslashes($m[7]);
				elseif (isset($m[8]))
					$atts[] = stripcslashes($m[8]);
			}
		} else {
			$atts = ltrim($text);
		}
		return $atts;
	}

	/**
	 * Combine user attributes with known attributes and fill in defaults when needed.
	 *
	 * The pairs should be considered to be all of the attributes which are
	 * supported by the caller and given as a list. The returned attributes will
	 * only contain the attributes in the $pairs list.
	 *
	 * If the $atts list has unsupported attributes, then they will be ignored and
	 * removed from the final returned list.
	 *
	 * @since 1.0
	 *
	 * @param array $pairs Entire list of supported attributes and their defaults.
	 * @param array $atts User defined attributes in parsecode tag.
	 * @return array Combined and filtered attribute list.
	 */
	function parsecode_atts($pairs, $atts) {
		$atts = (array)$atts;
		$out = array();
		foreach($pairs as $name => $default) {
			if ( array_key_exists($name, $atts) )
				$out[$name] = $atts[$name];
			else
				$out[$name] = $default;
		}
		return $out;
	}

	/**
	 * Remove all parsecode tags from the given content.
	 *
	 * @since 1.0
	 * @uses $parsecode_tags
	 *
	 * @param string $content Content to remove parsecode tags.
	 * @return string Content without parsecode tags.
	 */
	function strip_parsecodes( $content ) {
		global $parsecode_tags;

		if (empty($parsecode_tags) || !is_array($parsecode_tags))
			return $content;

		$pattern = get_parsecode_regex();

		return preg_replace_callback( "/$pattern/s", 'strip_parsecode_tag', $content );
	}

	function strip_parsecode_tag( $m ) {
		// allow [[foo]] syntax for escaping a tag
		if ( $m[1] == '[' && $m[6] == ']' ) {
			return substr($m[0], 1, -1);
		}

		return $m[1] . $m[6];
	}

	Hooks::add_filter('the_custom_page_content', 'do_parsecode', 11); // AFTER tt_autop()
	
	function et_autop($pee, $br = 1) {
	
		if ( trim($pee) === '' )
			return '';
		$pee = $pee . "\n"; // just to make things a little easier, pad the end
		$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
		// Space things out a little
		$allblocks = '(?:table|thead|tfoot|caption|col|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|option|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr|fieldset|legend|section|article|aside|hgroup|header|footer|nav|figure|figcaption|details|menu|summary)';
		$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
		$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
		$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
		if ( strpos($pee, '<object') !== false ) {
			$pee = preg_replace('|\s*<param([^>]*)>\s*|', "<param$1>", $pee); // no pee inside object/embed
			$pee = preg_replace('|\s*</embed>\s*|', '</embed>', $pee);
		}
		$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
		// make paragraphs, including one at the end
		$pees = preg_split('/\n\s*\n/', $pee, -1, PREG_SPLIT_NO_EMPTY);
		$pee = '';
		foreach ( $pees as $tinkle )
			$pee .= '<p>' . trim($tinkle, "\n") . "</p>\n";
		$pee = preg_replace('|<p>\s*</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
		$pee = preg_replace('!<p>([^<]+)</(div|address|form)>!', "<p>$1</p></$2>", $pee);
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
		$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
		$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
		$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
		if ($br) {
			$pee = preg_replace_callback('/<(script|style).*?<\/\\1>/s', '_autop_newline_preservation_helper', $pee);
			$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
			$pee = str_replace('<TTPreserveNewline />', "\n", $pee);
		}
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
		$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
		if (strpos($pee, '<pre') !== false)
			$pee = preg_replace_callback('!(<pre[^>]*>)(.*?)</pre>!is', 'clean_pre', $pee );
		$pee = preg_replace( "|\n</p>$|", '</p>', $pee );
	
		return $pee;
	}
	
	function _autop_newline_preservation_helper( $matches ) {
		return str_replace("\n", "<TTPreserveNewline />", $matches[0]);
	}
	
	function parsecode_unautop( $pee ) {
		global $parsecode_tags;
	
		if ( empty( $parsecode_tags ) || !is_array( $parsecode_tags ) ) {
			return $pee;
		}
	
		$tagregexp = join( '|', array_map( 'preg_quote', array_keys( $parsecode_tags ) ) );
	
		$pattern =
			  '/'
			. '<p>'                              // Opening paragraph
			. '\\s*+'                            // Optional leading whitespace
			. '('                                // 1: The parsecode
			.     '\\['                          // Opening bracket
			.     "($tagregexp)"                 // 2: parsecode name
			.     '\\b'                          // Word boundary
			                                     // Unroll the loop: Inside the opening parsecode tag
			.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
			.     '(?:'
			.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
			.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
			.     ')*?'
			.     '(?:'
			.         '\\/\\]'                   // Self closing tag and closing bracket
			.     '|'
			.         '\\]'                      // Closing bracket
			.         '(?:'                      // Unroll the loop: Optionally, anything between the opening and closing parsecode tags
			.             '[^\\[]*+'             // Not an opening bracket
			.             '(?:'
			.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing parsecode tag
			.                 '[^\\[]*+'         // Not an opening bracket
			.             ')*+'
			.             '\\[\\/\\2\\]'         // Closing parsecode tag
			.         ')?'
			.     ')'
			. ')'
			. '\\s*+'                            // optional trailing whitespace
			. '<\\/p>'                           // closing paragraph
			. '/s';
	
		return preg_replace( $pattern, '$1', $pee );
	}