<?php
// $regStr = '/^[A-Za-z-éèêëàâäôöûüùç\'. ]+$/';
// $regDate = '/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/';
// $regPhone = '/^(01|02|03|04|05|06|07|08|09)[ .-]?[0-9]{2}[ .-]?[0-9]{2}[ .-]?[0-9]{2}[ .-]?[0-9]{2}$/';

define('REG_STR_NO_INT', '/^[A-Za-z-éèêëàâäôöûüùç\'. ]+$/');
define('REG_BIRTH_DATE', '/^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/');
define('REG_PHONE', '/^(01|02|03|04|05|06|07|08|09)[ .-]?[0-9]{2}[ .-]?[0-9]{2}[ .-]?[0-9]{2}[ .-]?[0-9]{2}$/');