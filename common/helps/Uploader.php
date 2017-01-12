<?php
/**
 * 上传组件API
 * 
 * @copyright 2012 成都第四城科技有限责任公司 版权所有
 * @author ChengWQ
 * @version 0.2
 */
namespace app\common\helps;


/**
 * 上传API类， 将文件上传至附件服务器
 */
class Uploader {
    static $error;
    static $filename;
    static $extname;
    static $upfile;
    static $filesize;
    static $mk = 1;// 是否需要水印
	public  static function up($filename,$more=0) {
		$setting =  array(
			'allow_max_size' => 5 * 1024 * 1024,
			'allow_file_type' => array('.gif', '.jpg', '.jpeg', '.swf', '.png')
		);
		if($more){
			$file = $filename;
		}else{
			$file = $_FILES[$filename];
		}
		
		//无上传文件抛错
		if (!is_uploaded_file($file['tempName'])) {
			self::$error = '文件上传失败，请重试！';
			return false;
		}
		
		//文件名
		self::$filename	= $file['name'];
		//上传后的文件
		self::$upfile	= $file['tempName'];
		//文件大小
		self::$filesize	= $file['size'];
		//文件扩展名
		self::$extname	= self::getExtName();

		/*
		 * 文件类型检查
		 */
		if (!in_array('.'.self::$extname, $setting['allow_file_type'])) {
			self::$error = '只允许上传.jpg，.gif，.jpeg格式的文件!';
			return false;
		}
		
		/*
		 * 文件大小检查
		 */
		if (self::$filesize > $setting['allow_max_size']) {
			self::$error = '文件不能超过' . $setting['allow_max_size'] ;
			return false;
		}
		
		//上传至附件服务器
		return self::post();
	}
	
	/*
	 * 将上传的文件post到附件服务器
	 */
	public static function post() {
		$url = 'http://upload.api.91town.com/upload.php';
		
		$id = mt_rand(10000, 99999);
		$key = '791d6ca209868e61262ee30eee96b20e';
		
		$data = array();
		$data['KEY'] 	= $id;
		$data['ID'] 	= md5($id.$key);
		$data['SID'] 	= 5;
		$data['EXT'] 	= 'A';
		$data['SL'] 	= 5;
		$data['MK']     = self::$mk == '1' ? '1' : '0';
		$data['CP'] 	= 0;
		$data['CPQ'] 	= 1;
		$data['MKP'] 	= 7;		
		$data['SI'] 	= 0;
		$data['fileExt'] = '*.jpg;*.gif;*.png;*.bmp;*.jpeg;*.swf';
		$results = self::postData($url, $data);
		$results = explode("||", $results);
		if ($results[0]!='success') {
			self::$error = $results[1]; return false;
		}
		return $results[1];
	}

    public static function postData($posturl, $data=array()) {
		$url = parse_url($posturl);
		if (!$url) return "couldn't parse url";
		if (!isset($url['port'])) $url['port'] = "";
		if (!isset($url['query'])) $url['query'] = "";

		$boundary = "---------------------------".substr(md5(rand(0,32000)),0,10);
		$boundary_2 = "--$boundary";

		$content = $encoded = "";
		if ($data){
			while (list($k,$v) = each($data)){
				$encoded .= $boundary_2."\r\nContent-Disposition: form-data; name=\"".$k."\"\r\n\r\n";
				//if ($k != 'fileExt') $v = rawurlencode($v);
				$encoded .= $v."\r\n";
			}
		}
		
		if (self::$upfile){
			$type = self::getContentType();
			$encoded .= $boundary_2."\r\nContent-Disposition: form-data; name=\"Filedata\"; filename=".self::$filename."\r\nContent-Type: $type\r\n\r\n";
			$content = join("", file(self::$upfile));
			$encoded.=$content."\r\n";
		}

		$encoded .= "\r\n".$boundary_2."--\r\n\r\n";
		$length = strlen($encoded);

		$fp = fsockopen($url['host'], $url['port'] ? $url['port'] : 80);
		if(!$fp) return "Failed to open socket to $url[host]";

		fputs($fp, sprintf("POST %s%s%s HTTP/1.0\r\n", $url['path'], $url['query'] ? "?" : "", $url['query']));
		fputs($fp, "Host: $url[host]\r\n");
		fputs($fp, "Content-type: multipart/form-data; boundary=$boundary\r\n");
		fputs($fp, "Content-length: ".$length."\r\n");
		fputs($fp, "Connection: close\r\n\r\n");
		fputs($fp, $encoded);

		$line = fgets($fp,1024);
		//if (!eregi("^HTTP/1\.. 200", $line)) return null;
		if (!preg_match("/^HTTP\/1\.. 200/i", $line)) return null;

		$results = "";
		$inheader = 1;
		while(!feof($fp)){
			$line = fgets($fp,1024);
			if($inheader && ($line == "\r\n" || $line == "\r\r\n")){
				$inheader = 0;
			}elseif(!$inheader){
				$results .= $line;
			}
		}
		fclose($fp);
		return $results;
	}
	
	/**
	 * 返回错误信息
	 * @return String 错误信息
	 */
    public static function getError() {
		return self::$error;
	}

    public static function getContentType() {
		$mimetypes = array(
				'ez' => 'application/andrew-inset',
				'hqx' => 'application/mac-binhex40',
				'cpt' => 'application/mac-compactpro',
				'doc' => 'application/msword',
				'bin' => 'application/octet-stream',
				'dms' => 'application/octet-stream',
				'lha' => 'application/octet-stream',
				'lzh' => 'application/octet-stream',
				'exe' => 'application/octet-stream',
				'class' => 'application/octet-stream',
				'so' => 'application/octet-stream',
				'dll' => 'application/octet-stream',
				'oda' => 'application/oda',
				'pdf' => 'application/pdf',
				'ai' => 'application/postscript',
				'eps' => 'application/postscript',
				'ps' => 'application/postscript',
				'smi' => 'application/smil',
				'smil' => 'application/smil',
				'mif' => 'application/vnd.mif',
				'xls' => 'application/vnd.ms-excel',
				'ppt' => 'application/vnd.ms-powerpoint',
				'wbxml' => 'application/vnd.wap.wbxml',
				'wmlc' => 'application/vnd.wap.wmlc',
				'wmlsc' => 'application/vnd.wap.wmlscriptc',
				'bcpio' => 'application/x-bcpio',
				'vcd' => 'application/x-cdlink',
				'pgn' => 'application/x-chess-pgn',
				'cpio' => 'application/x-cpio',
				'csh' => 'application/x-csh',
				'dcr' => 'application/x-director',
				'dir' => 'application/x-director',
				'dxr' => 'application/x-director',
				'dvi' => 'application/x-dvi',
				'spl' => 'application/x-futuresplash',
				'gtar' => 'application/x-gtar',
				'hdf' => 'application/x-hdf',
				'js' => 'application/x-javascript',
				'skp' => 'application/x-koan',
				'skd' => 'application/x-koan',
				'skt' => 'application/x-koan',
				'skm' => 'application/x-koan',
				'latex' => 'application/x-latex',
				'nc' => 'application/x-netcdf',
				'cdf' => 'application/x-netcdf',
				'sh' => 'application/x-sh',
				'shar' => 'application/x-shar',
				'swf' => 'application/x-shockwave-flash',
				'sit' => 'application/x-stuffit',
				'sv4cpio' => 'application/x-sv4cpio',
				'sv4crc' => 'application/x-sv4crc',
				'tar' => 'application/x-tar',
				'tcl' => 'application/x-tcl',
				'tex' => 'application/x-tex',
				'texinfo' => 'application/x-texinfo',
				'texi' => 'application/x-texinfo',
				't' => 'application/x-troff',
				'tr' => 'application/x-troff',
				'roff' => 'application/x-troff',
				'man' => 'application/x-troff-man',
				'me' => 'application/x-troff-me',
				'ms' => 'application/x-troff-ms',
				'ustar' => 'application/x-ustar',
				'src' => 'application/x-wais-source',
				'xhtml' => 'application/xhtml+xml',
				'xht' => 'application/xhtml+xml',
				'zip' => 'application/zip',
				'au' => 'audio/basic',
				'snd' => 'audio/basic',
				'mid' => 'audio/midi',
				'midi' => 'audio/midi',
				'kar' => 'audio/midi',
				'mpga' => 'audio/mpeg',
				'mp2' => 'audio/mpeg',
				'mp3' => 'audio/mpeg',
				'aif' => 'audio/x-aiff',
				'aiff' => 'audio/x-aiff',
				'aifc' => 'audio/x-aiff',
				'm3u' => 'audio/x-mpegurl',
				'ram' => 'audio/x-pn-realaudio',
				'rm' => 'audio/x-pn-realaudio',
				'rpm' => 'audio/x-pn-realaudio-plugin',
				'ra' => 'audio/x-realaudio',
				'wav' => 'audio/x-wav',
				'pdb' => 'chemical/x-pdb',
				'xyz' => 'chemical/x-xyz',
				'bmp' => 'image/bmp',
				'gif' => 'image/gif',
				'ief' => 'image/ief',
				'jpeg' => 'image/jpeg',
				'jpg' => 'image/jpeg',
				'jpe' => 'image/jpeg',
				'png' => 'image/png',
				'tiff' => 'image/tiff',
				'tif' => 'image/tiff',
				'djvu' => 'image/vnd.djvu',
				'djv' => 'image/vnd.djvu',
				'wbmp' => 'image/vnd.wap.wbmp',
				'ras' => 'image/x-cmu-raster',
				'pnm' => 'image/x-portable-anymap',
				'pbm' => 'image/x-portable-bitmap',
				'pgm' => 'image/x-portable-graymap',
				'ppm' => 'image/x-portable-pixmap',
				'rgb' => 'image/x-rgb',
				'xbm' => 'image/x-xbitmap',
				'xpm' => 'image/x-xpixmap',
				'xwd' => 'image/x-xwindowdump',
				'igs' => 'model/iges',
				'iges' => 'model/iges',
				'msh' => 'model/mesh',
				'mesh' => 'model/mesh',
				'silo' => 'model/mesh',
				'wrl' => 'model/vrml',
				'vrml' => 'model/vrml',
				'css' => 'text/css',
				'html' => 'text/html',
				'htm' => 'text/html',
				'asc' => 'text/plain',
				'txt' => 'text/plain',
				'rtx' => 'text/richtext',
				'rtf' => 'text/rtf',
				'sgml' => 'text/sgml',
				'sgm' => 'text/sgml',
				'tsv' => 'text/tab-separated-values',
				'wml' => 'text/vnd.wap.wml',
				'wmls' => 'text/vnd.wap.wmlscript',
				'etx' => 'text/x-setext',
				'xsl' => 'text/xml',
				'xml' => 'text/xml',
				'mpeg' => 'video/mpeg',
				'mpg' => 'video/mpeg',
				'mpe' => 'video/mpeg',
				'qt' => 'video/quicktime',
				'mov' => 'video/quicktime',
				'mxu' => 'video/vnd.mpegurl',
				'avi' => 'video/x-msvideo',
				'movie' => 'video/x-sgi-movie',
				'ice' => 'x-conference/x-cooltalk',
			);
		return $mimetypes[self::$extname];
	}

    public static function getExtName() {
        $args = explode('.', self::$filename);
		return strtolower(end($args));
	}
	
	/* 
	 * 返回格式化文件大小
	 */
    public static function fileMaxSize() {
		global $setting;
		$file_size	= $setting['allow_max_size'];
		$rtv 	= '';
		$size 	= $setting['allow_max_size'] / (float)1024;
		
		if ($size > 1024) {
			$size = $size / 1024;
			$rtv = "{$size}M";
		} else {
			$rtv = "{$size}K";
		}
		return $rtv;
	}
}