<?php
class ErrorHandler {
		//private constructor to prevent direct creation of objects
		private function __construct() {
			
		}
		//set user error handler method to ErrorHandler::Handler method
		public static function SetHandler ($errTypes=ERROR_TYPES) {
			return set_error_handler(array('ErrorHandler', 'Handler'), $errTypes);	
		}
		
		//Error handler method
		public static function Handler($errNo, $errStr, $errFile, $errLine) {
			$backtrace = ErrorHandler::GetBacktrace(2);	
			
			//Error message to be displayed logged or mailed
			$error_message = '<br>ERRNO: '.$errNo.'<br>Text: '.$errStr.'<br>LOCATION: '.$errFile.', Line'. $errLine.', at '.date('F j,Y, g:i a').'<br>Showing Backtrace:<br>'.$backtrace.'<br><br>';
				
			//Email the error details
			if (SEND_ERROR_MAIL === true)
				error_log($error_message, 1, ADMIN_ERROR_MAIL, 'FROM: '.SENDMAIL_FROM .'\r\nTo: '.ADMIN_ERROR_MAIL);
				
			if (LOG_ERRORS === true)
				error_log($error_message, 3, LOG_ERRORS_FILE);
				
			//warning: don't abort execution if IS_WARNING_FATAL is false E_NOTICE or E_USER_NOTICE errors don't abort execution
			if (($errNo == E_WARNING && IS_WARNING_FATAL == false) || ($errNo == E_NOTICE || $errNo == E_USER_NOTICE)) {
			//if error is fatal
				//show messages only if debugging is true
				if (DEBUGGING == true)
					echo '<div class="panel panel-default"><div class="panel-body">'.$error_message.'</div></div>';	
			}else {
				//if error is fatal
				//show error message
				if (DEBUGGING == true)
					echo '<div class="panel panel-default"><div class="panel-body">'.$error_message.'</div></div>';
				else {
					// Clean output buffer
					ob_clean();
					
					// Load 500.php
					include '500.php';
					
					// Clear the output buffer and stop execution
					flush();
					ob_flush();
					ob_end_clean();
					exit();
				}
				//stop processing the request
				exit();
			}
		}
		// Builds backtrace message
public static function GetBacktrace($irrelevantFirstEntries)
{
$s = '';
$MAXSTRLEN = 64;
$trace_array = debug_backtrace();
for ($i = 0; $i < $irrelevantFirstEntries; $i++)
array_shift($trace_array);
$tabs = sizeof($trace_array) - 1;
foreach ($trace_array as $arr)
{
$tabs -= 1;
if (isset ($arr['class']))
$s .= $arr['class'] . '.';
$args = array ();
if (!empty ($arr['args']))
foreach ($arr['args']as $v)
{
if (is_null($v))
$args[] = 'null';
elseif (is_array($v))
$args[] = 'Array[' . sizeof($v) . ']';
elseif (is_object($v))
$args[] = 'Object: ' . get_class($v);
elseif (is_bool($v))
$args[] = $v ? 'true' : 'false';
else
{
$v = (string)@$v;
$str = htmlspecialchars(substr($v, 0, $MAXSTRLEN));
if (strlen($v) > $MAXSTRLEN)
$str .= '...';
$args[] = '"' . $str . '"';
}
}
$s .= $arr['function'] . '(' . implode(', ', $args) . ')';
$line = (isset ($arr['line']) ? $arr['line']: 'unknown');
$file = (isset ($arr['file']) ? $arr['file']: 'unknown');
$s .= sprintf(' # line %4d, file: %s', $line, $file);
$s .= "\n";
}
return $s;
}
}
?>