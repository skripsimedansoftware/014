<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @package    Codeigniter
 * @subpackage MY_File
 * @category   Helpers
 * @author     Agung Dirgantara <agungmasda29@gmail.com>
 */

if (!function_exists('file_mime'))
{	
	/**
	 * Get file mime
	 *
	 * @link       https://www.codegrepper.com/code-examples/php/php+get+file+mime+type Reference
	 *
	 * @param      string  $file   Path to file
	 *
	 * @return     string  mime name or "unknown"
	 */
	function file_mime($file)
	{
		$ci =& get_instance();

		$file_mime = FCPATH.'mime.json';

		if (file_exists($file_mime))
		{
			$mimes = json_decode(file_get_contents($file_mime), TRUE);
		}
		else
		{
			$mimes_file = file_get_contents('http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types');

			preg_match_all('#^([^\s]{2,}?)\s+(.+?)$#ism', $mimes_file, $matches, PREG_SET_ORDER);

			foreach ($matches as $match)
			{
				$exts = explode(' ', $match[2]);

				foreach ($exts as $ext)
				{
					$mimes[$ext] = $match[1];
				}
			}
		}

		$content_mime = 'unknown';

		if (is_file($file))
		{
			if (isset(pathinfo($file)['extension']))
			{
				$content_ext = pathinfo($file)['extension'];

				if (isset($mimes[$content_ext]))
				{
					$content_mime = $mimes[$content_ext];
				}
				elseif (isset($ci->output->mimes[$content_ext]))
				{
					if (is_array($ci->output->mimes[$content_ext]))
					{
						$content_mime = array_shift($ci->output->mimes[$content_ext]);
					}
					else
					{
						$content_mime = $mimes[$content_ext];
					}
				}
				else
				{
					if (is_readable($file) && is_executable($file))
					{
						$finfo = finfo_open(FILEINFO_MIME_TYPE);
						$content_mime = finfo_file($finfo, $file);

						if ($content_mime === null | $content_mime === '')
						{
							$content_mime = 'application/octet-stream';
						}
						else
						{
							$content_mime = $content_mime;
						}

						finfo_close($finfo);
					}
					else
					{
						$content_mime = 'application/octet-stream';
					}
				}
			}
		}
		else
		{
			// mofify mime content?
			$content_mime = 'unknown';
		}

		return $content_mime;
	}
}

/* End of file MY_file_helper.php */
/* Location : ./application/helpers/MY_file_helper.php */
