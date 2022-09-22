<?php

// full details: http://greenbytes.de/tech/tc2231/

header("Content-Type: application/binary");
//header("Content-Type: text/plain; charset=utf-8");
// IE8+, see: http://blogs.msdn.com/b/ie/archive/2008/07/02/ie8-security-part-v-comprehensive-protection.aspx
// also see http://msdn.microsoft.com/en-us/library/ie/gg622941%28v=vs.85%29.aspx
// also see http://security.stackexchange.com/questions/12896/does-x-content-type-options-really-prevent-content-sniffing-attacks
header("X-Content-Type-Options: nosniff");
$fallback = "resume.txt";
$unicode = "résumé.txt";
// see RFC 5987
header("Content-Disposition: attachment; filename=".$fallback."; filename*=utf-8''".rawurlencode($unicode));

echo
  "The brief résumé of Joeri Sebrechts".PHP_EOL.
  PHP_EOL .
  "  2004 - present: MCS nv";
