<?php
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");
 
    $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
    $rssfeed .= '<rss version="2.0">';
    $rssfeed .= '<channel>';
    $rssfeed .= '<title>My RSS feed</title>';
    $rssfeed .= '<link>http://www.mywebsite.com</link>';
    $rssfeed .= '<description>This is an example RSS feed</description>';
    $rssfeed .= '<language>en-us</language>';
    $rssfeed .= '<copyright>Copyright (C) 2009 mywebsite.com</copyright>';
 
        $rssfeed .= '<item>';
        $rssfeed .= '<title>Edgar Meij\'s Ph.D. Thesis</title>';
        $rssfeed .= '<description>This is the RSS feed of the website accompanying Edgar Meij\'s Ph.D. thesis, entitled "Combining Concepts and Language Models for Information Access."</description>';
        $rssfeed .= '<link>http://phdthes.is/</link>';
        $rssfeed .= '<pubDate>Fri, 01 Oct 2010 13:00:00 GMT</pubDate>';
        $rssfeed .= '</item>';
 
    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
 
    echo $rssfeed;

// txt2rss.php -- Glob text files into an RSS 1.0 XML file.

// Copyright (C) 2005, 2006 Aaron Hawley <ashawley@gnu.uvm.edu>

// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License as
// published by the Free Software Foundation; either version 2 of the
// License, or (at your option) any later version.

// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.

// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
// 02110-1301, USA.

// http://www.uvm.edu/~ashawley/php/txt2rss.html

// $Id: txt2rss.php,v 1.3 2007/01/10 19:12:12 ashawley Exp ashawley $

/** RssLib
 * Some auxillary RSS 1.0 functions.
 */
// class RssLib
// {
// 	var $date_format = "Y-m-d\\Th:i:sO";
// 	function setDateFormat($fmt)
// 	{
// 		$this->date_format;
// 	} // end func setDateFormat

// 	function formatDate($date)
// 	{
// 		return $this->w3cDateTimeFormat(date($this->date_format, $date));
// 	} // end func formatDate

// 	// http://www.w3.org/TR/NOTE-datetime
// 	// Profile of ISO 8601
// 	// http://www.iso.ch/iso/en/prods-services/popstds/datesandtime.html
// 	function w3cDateTimeFormat($date)
// 	{
// 		return preg_replace('/\d\d$/', ':\0', $date);
// 	} // end func w3cDateTimeFormat
	
// } // end class RssLib

// /** TextFileToRssItem
//  * Takes a text file RSS item data and can give the corresponding XML.
//  */
// class TextFileToRssItem extends RssLib
// {
// 	var $rss_lines = array('url' => "http://",
// 	                       'title' => "No Title",
// 	                       'description' => "No description",
// 	                       'author' => "No Authors");

// 	function getArray($file)
// 	{
// 		if (!file_exists($file)) {
// 			return new Error("File does not exist", $file);
// 		}
// 		if (!is_readable($file)) {
// 			return new Error("File is not readable", $file);
// 		}
// 		$date = filemtime($file);
// 		$txt_file = new TextLineFile($this->rss_lines);
// 		$data = $txt_file->parseFile($file);
// 		if (Main::instance_of($data, 'Error')) {
// 			return $data;
// 		}
// 		$data['file'] = $file;
// 		$data['date'] = $this->formatDate($date);
// 		return $data;
// 	} // end func getArray

// 	function getItem($file)
// 	{
// 		$id = $this->getArray($file);
// 		if (Main::instance_of($id, 'Error')) {
// 			return $id;
// 		}
// 		$xml = '<item rdf:about="' . htmlspecialchars($id['url']) . '">'
// 		. "\n" . '  <!-- file: ' . htmlspecialchars($id['file']) . ' -->'
// 		. "\n" . '  <title>' . htmlspecialchars($id['title']) . '</title>'
// 		. "\n" . '  <link>' . htmlspecialchars($id['url']) . '</link>'
// 		. "\n" . '  <description>' . htmlspecialchars($id['description'])
// 		       . '</description>'
// 		. "\n" . '  <dc:creator>' . htmlspecialchars($id['author'])
// 		       . '</dc:creator>'
// 		. "\n" . '  <dc:date>' . htmlspecialchars($id['date'])
// 		       . '</dc:date>'
// 		. "\n" . '</item>';
// 		return array($id['url'] => $xml);
// 	} // end func getItem

// } // end class TextFileToRssItem

// /** TextFilesToRss
//  * Convert a text file (rss.txt) and text files provided with
//  * addFile(), and create a complete RSS 1.0 XML file.
//  * See Main() below for example.
//  */
// class TextFilesToRss extends TextFileToRssItem
// {
// 	// See TextFileToRssItem#rss_line_item
// 	var $rss_meta_lines = array('update_period' => "daily",
// 	                            'update_frequency' => "1");
// 	var $update_base = "1901-01-01T00:00+00:00";
// 	var $output_file = "rss.xml";
// 	var $meta_file = "rss.txt";
// 	var $template_file = "template.xml";
// 	var $files = array();
// 	var $template = array(); // Lines of template file.

// 	function TextFilesToRss($file)
// 	{
// 		$author_at = array_search('author', array_keys($this->rss_lines));
// 		$this->rss_lines = array_splice($this->rss_lines, 0, $author_at);
// 		$this->rss_meta_lines = array_merge($this->rss_lines,
// 		                                    $this->rss_meta_lines);
// 		$this->setOutputFile($file);
// 	} // end func TextFileToRss

// 	function setOutputFile($file)
// 	{
// 		$this->output_file = $file;
// 	} // end func setOutputFile

// 	function setTemplate($file)
// 	{
// 		$this->template_file = $file;
// 	} // end func setTemplate

// 	function setMetaFile($file)
// 	{
// 		$this->meta_file = $file;
// 	} // end func setMetaFile

// 	function addFile($file)
// 	{
// 		$this->files[] = $file;
// 	} // end func addFile

// 	function getFiles()
// 	{
// 		return $this->files;
// 	} // end func getFiles

// 	function getXml()
// 	{
// 		$meta = $this->getMetaData();
// 		if (Main::instance_of($meta, 'Error')) {
// 			return $meta;
// 		}
// 		$rss = $meta;

// 		$items = array();
// 		foreach ($this->getFiles() as $f) {
// 			$item = $this->processRssItemFile($f);
// 			if (Main::instance_of($item, 'Error')) {
// 				return $item;
// 			}
// 			list($url, $xml) = each($item);
// 			if (isset($items[$url])) {
// 				return new Error("Duplicate RSS item",
// 				                 "$url in $f");
// 			}
// 			$items[$url] = $xml;
// 		}
// 		$rss['item'] = $items;

// 		$list_items = array_keys($items);
// 		$rss['li'] = array();
// 		foreach ($list_items as $li) {
// 			$rss['li'][] = '<rdf:li rdf:resource="'
// 			             . htmlspecialchars($li) . '"/>';
// 		}

// 		$rss['file'] = $this->output_file;
// 	        $rss['update_base'] = $this->update_base;

// 		return $this->mergeWithTemplateFile($rss);
// 	} // end func getXml

// 	function processRssItemFile($file)
// 	{
// 		$txt2item = new TextFileToRssItem;
// 		$item = $txt2item->getItem($file);
// 		return $item;
// 	} // end func processRssItemFile

// 	function getMetaData()
// 	{
// 		$this->rss_lines = $this->rss_meta_lines;
// 		$meta = $this->getArray($this->meta_file);
// 		if (Main::instance_of($meta, 'Error')) {
// 			return $meta;
// 		}
// 		return $meta;
// 	} // end func getMetaData

// 	function mergeWithTemplateFile($rss)
// 	{
// 		if (!file_exists($this->template_file)) {
// 			return new Error("Template file not found",
// 			                 $this->template_file);
// 		}
// 		if (!is_readable($this->template_file)) {
// 			return new Error("Template file not readable",
// 			                 $this->template_file);
// 		}
// 		$this->template = file($this->template_file);
// 		$prefixes = array();
// 		$prefixes = $this->templateFileTagPrefixes();
// 		if (isset($rss['li'])) {
// 			$prefix = isset($prefixes['li']) ? $prefixes['li'] : "";
// 			$rss['li'] = join("\n$prefix", $rss['li']) . "\n";
// 		}
// 		if (isset($rss['item'])) {
// 			$prefix = isset($prefixes['item']) ? $prefixes['item'] : "";
// 			$rss['item'] = join("\n", $rss['item']);
// 			$rss['item'] = str_replace("\n", "\n$prefix", $rss['item'])
// 			             . "\n";
// 		}
// 		$tags_2_re = create_function('$t', 'return "/%%".$t."%%\n?/";');
// 		$tag_res = array_map($tags_2_re, array_keys($rss));
// 		$xml = "";
// 		foreach ($this->template as $line) {
// 			$xml .= preg_replace($tag_res, array_values($rss), $line);
// 		}
// 		return $xml . "\n";
// 	} // end func mergeWithTemplateFile

// 	// Retrieve the prefixes for each tag.
// 	// This work is only done for getting the indentation right.
// 	// But it's worth it!
// 	function templateFileTagPrefixes()
// 	{
// 		foreach ($this->template as $line) {
// 			preg_match_all("/^(.*)%%[^%]*?%%/", $line, &$p);
// 			while (isset($p[1]) && list($k, $prefix) = each($p[1])) {
// 				preg_match_all("/%%([^%]*?)%%/", $line, &$m);
// 				while (isset($m[1]) && list($k, $tag) = each($m[1])) {
// 					$prefixes[$tag] = $prefix;
// 				}
// 			}
// 		}
// 		return $prefixes;
// 	} // end func templateFileTagPrefixes

// } // end class TextFilesToRss

// /** TextLineFile
//  * Each line is presumed the value of an array.
//  * Provide an array of keys to be given each value.
//  */
// class TextLineFile
// {
// 	var $lines;
// 	var $lines_key;
// 	var $n_fields;
// 	function TextLineFile($key = null)
// 	{
// 		$this->setLineKey($key);
// 	} // end func TextLineFile

// 	function setLineKey($key = null)
// 	{
// 		if (isset($key)) {
// 			$this->lines_key = $key;
// 			$n_fields = count($this->lines_key);
// 		}
// 	} // end func setLineKey

// 	function nFields()
// 	{
// 		return $this->n_fields;
// 	} // end func nFields

// 	function parseFile($file)
// 	{
// 		$this->TextLineFile();
// 		$lines = file($file);
// 		if (count($lines) <= $this->nFields()) {
// 			return new Error("Incomplete text file", $file);
// 		}
// 		$lines = array_map('chop', $lines);
// 		return Main::array_combine(array_keys($this->lines_key),
// 		                           $lines);
// 	} // end func parseFile

// } // end class TextLineFile

// /** Error
//  * A simple error class.
//  */  
// class Error {
// 	var $message;
// 	var $problem;

// 	function Error($msg, $prob)
// 	{
// 		$this->message = $msg;
// 		$this->problem = $prob;
// 	} // end func Error

// 	function text()
// 	{
// 		return $this->message . ": " . $this->problem . "\n";
// 	} // end func text

// } // end class Error

// /** Main
//  * The main routine, and some functions needed for PHP 4.0 compatability.
//  */
// class Main
// {
// 	function main($glob, $out)
// 	{
// 		$rss = new TextFilesToRss($out);
// 		$rss->setMetaFile("rss.txt");
// 		$rss->setTemplate("rss.xml");
// 		$files = array_reverse(glob($glob));
// 		foreach ($files as $file) {
// 			$rss->addFile($file);
// 		}
// 		$str = $rss->getXml();
// 		if (Main::instance_of($str, 'Error')) {
// 			if (strpos(($http = $_SERVER['SERVER_PROTOCOL']), 'HTTP') !== false) {
// 				header("$http 500 Internal Server Error");
// 			}
// 			header("Content-type: text/plain");
// 			print $str->text();
// 		} else {
// 			header("Content-type: text/xml; charset=utf-8");
// 			print $str;
// 		}
// 	} // end func main

// 	function instance_of($a, $b)
// 	{
// 		if (phpversion() >= 5) {
// 			return $a instanceof $b;
// 		} // else
// 		return (is_object($a) && is_string($b)
// 		        && get_class($a) === strtolower($b))
// 		       || (is_object($b) && is_string($a)
// 		           && get_class($b) === strtolower($a));
// 	} // end func instance_of

// 	function array_combine($keys, $values)
// 	{
// 		$n = array(); // New array.
// 		foreach ($keys as $k) {
// 			list($vkey, $v) = each($values);
// 			$n[$k] = $v;
// 		}
// 		return $n;
// 	} // end func array_combine

// } // end class Main

// $main = new Main("event*.txt", "events.xml");

?>