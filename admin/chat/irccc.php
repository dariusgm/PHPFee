<?php

/*
 *
 * Internet Relay Chat Connection Class
 *
 * by Matthias Lohr
 * malo@dasevil.de
 *
 */

define("IRCCC_VERSION","0.2.1");

define("IRCCC_RPL_TRACELINK",           "200");
define("IRCCC_RPL_TRACECONNECTING",     "201");
define("IRCCC_RPL_TRACEHANDSHAKE",      "202");
define("IRCCC_RPL_TRACEUNKNOWN",        "203");
define("IRCCC_RPL_TRACEOPERATOR",       "204");
define("IRCCC_RPL_TRACEUSER",           "205");
define("IRCCC_RPL_TRACESERVER",         "206");
define("IRCCC_RPL_TRACENEWTYPE",        "208");
define("IRCCC_RPL_STATSLINKINFO",       "211");
define("IRCCC_RPL_STATSCOMMANDS",       "212");
define("IRCCC_RPL_STATSCLINE",          "213");
define("IRCCC_RPL_STATSNLINE",          "214");
define("IRCCC_RPL_STATSSILINE",         "215");
define("IRCCC_RPL_STATSSKLINE",         "216");
define("IRCCC_RPL_STATSYLINE",          "218");
define("IRCCC_RPL_ENDOFSTATS",          "219");
define("IRCCC_RPL_UMODEIS",             "221");
define("IRCCC_RPL_STATSLLINE",          "241");
define("IRCCC_RPL_STATSUPTIME",         "242");
define("IRCCC_RPL_STATSOLINE",          "243");
define("IRCCC_RPL_STATSHLINE",          "244");
define("IRCCC_RPL_LUSERCLIENT",         "251");
define("IRCCC_RPL_LUSEROP",             "252");
define("IRCCC_RPL_LUSERUNKNOWN",        "253");
define("IRCCC_RPL_LUSERCHANNELS",       "254");
define("IRCCC_RPL_LUSERME",             "255");
define("IRCCC_RPL_ADMINME",             "256");
define("IRCCC_RPL_ADMINLOC1",           "257");
define("IRCCC_RPL_ADMINLOC2",           "258");
define("IRCCC_RPL_ADMINEMAIL",          "259");
define("IRCCC_RPL_TRACELOG",            "261");

define("IRCCC_RPL_NONE",                "300");
define("IRCCC_RPL_USERHOST",            "302");
define("IRCCC_RPL_AWAY",                "301");
define("IRCCC_RPL_ISON",                "303");
define("IRCCC_RPL_UNAWAY",              "305");
define("IRCCC_RPL_NOAWAY",              "306");
define("IRCCC_RPL_WHOISUSER",           "311");
define("IRCCC_RPL_WHOISSERVER",         "312");
define("IRCCC_RPL_WHOISOPERATOR",       "313");
define("IRCCC_RPL_WHOWASUSER",          "314");
define("IRCCC_RPL_ENDOFWHO",            "315");
define("IRCCC_RPL_WHOISIDLE",           "317");
define("IRCCC_RPL_ENDOFWHOIS",          "318");
define("IRCCC_RPL_WHOISCHANNELS",       "319");
define("IRCCC_RPL_LISTSTART",           "321");
define("IRCCC_RPL_LIST",                "322");
define("IRCCC_RPL_LISTEND",             "323");
define("IRCCC_RPL_CHANNELMODEIST",      "324");
define("IRCCC_RPL_NOTOPIC",             "331");
define("IRCCC_RPL_TOPIC",               "332");
define("IRCCC_RPL_INVITING",            "341");
define("IRCCC_RPL_SUMMONING",           "342");
define("IRCCC_RPL_VERSION",             "351");
define("IRCCC_RPL_WHOREPLY",            "352");
define("IRCCC_RPL_NAMREPLY",            "353");
define("IRCCC_RPL_LINKS",               "364");
define("IRCCC_RPL_ENDOFLINKS",          "365");
define("IRCCC_RPL_ENDOFNAMES",          "366");
define("IRCCC_RPL_BANLIST",             "367");
define("IRCCC_RPL_ENDOFBANLIST",        "368");
define("IRCCC_RPL_ENDOFWHOWAS",         "369");
define("IRCCC_RPL_INFO",                "371");
define("IRCCC_RPL_MOTD",                "372");
define("IRCCC_RPL_ENDOFINFO",           "374");
define("IRCCC_RPL_MOTDSTART",           "375");
define("IRCCC_RPL_ENDOFMOTD",           "376");
define("IRCCC_RPL_YOUREOPER",           "381");
define("IRCCC_RPL_REHASHING",           "382");
define("IRCCC_RPL_TIME",                "391");
define("IRCCC_RPL_USERSSTART",          "392");
define("IRCCC_RPL_USERS",               "393");
define("IRCCC_RPL_ENDOFUSERS",          "394");
define("IRCCC_RPL_NOUSERS",             "395");

define("IRCCC_ERR_NOSUCHNICK",          "401");
define("IRCCC_ERR_NOSUCHSERVER",        "402");
define("IRCCC_ERR_NOSUCHCHANNEL",       "403");
define("IRCCC_ERR_CANNOTSENDTOCHAN",    "404");
define("IRCCC_ERR_TOOMANYCHANNELS",     "405");
define("IRCCC_ERR_WASNOSUCHNICK",       "406");
define("IRCCC_ERR_TOOMANYTARGETS",      "407");
define("IRCCC_ERR_NOORIGIN",            "409");
define("IRCCC_ERR_NORECIPIENT",         "411");
define("IRCCC_ERR_NOTEXTTOSEND",        "412");
define("IRCCC_ERR_NOTOPLEVEL",          "413");
define("IRCCC_ERR_WILDTOPLEVEL",        "414");
define("IRCCC_ERR_UNKNOWNCOMMAND",      "421");
define("IRCCC_ERR_NOMOTD",              "422");
define("IRCCC_ERR_NOADMININFO",         "423");
define("IRCCC_ERR_FILEERROR",           "424");
define("IRCCC_ERR_NONICKNAMEGIVEN",     "431");
define("IRCCC_ERR_ERRONEUSNICKNAME",    "432");
define("IRCCC_ERR_NICKNAMEINUSE",       "433");
define("IRCCC_ERR_NICKCOLLISION",       "436");
define("IRCCC_ERR_USERNOTINCHANNEL",    "441");
define("IRCCC_ERR_NOTONCHANNEL",        "442");
define("IRCCC_ERR_USERONCHANNEL",       "443");
define("IRCCC_ERR_NOLOGIN",             "444");
define("IRCCC_ERR_SUMMONDISABLED",      "445");
define("IRCCC_ERR_USERSDISABLED",       "446");
define("IRCCC_ERR_NOTREGISTERED",       "451");
define("IRCCC_ERR_NEEDMOREPARAMS",      "461");
define("IRCCC_ERR_ALREADYREGISTERED",   "462");
define("IRCCC_ERR_NOPERMFORHOST",       "463");
define("IRCCC_ERR_PASSWDMISMATCH",      "464");
define("IRCCC_ERR_YOUREBANNEDCREEP",    "465");
define("IRCCC_ERR_KEYSET",              "467");
define("IRCCC_ERR_CHANNELISFULL",       "471");
define("IRCCC_ERR_UNKNOWNMODE",         "472");
define("IRCCC_ERR_INVITEONLYCHAN",      "473");
define("IRCCC_ERR_BANNEDFROMCHAN",      "474");
define("IRCCC_ERR_BADCHANNELKEY",       "475");
define("IRCCC_ERR_NOPRIVILEGES",        "481");
define("IRCCC_ERR_CHANOPRIVSNEEDED",    "482");
define("IRCCC_ERR_CANTKILLSERVER",      "483");
define("IRCCC_ERR_NOOPERHOST",          "491");

define("IRCCC_ERR_UMODEUNKNOWNFLAG",    "501");
define("IRCCC_ERR_USERSDONTMATCH",      "502");

define("IRCCC_SYS_NOTCONNECTED",            0);
define("IRCCC_SYS_SENDINGNICK",             1);
define("IRCCC_SYS_SENDINGUSER",             2);
define("IRCCC_SYS_CONNECTED",               3);

class irccc
{
  var $buffer;
  var $chanlist;
  var $hooks;
  var $remote;
  var $run;
  var $user;

  function irccc($host,$port,$nickname,$username,$realname,$password = "")
  {
    $this->run = true;
    $this->remote['host'] = $host;
    $this->remote['port'] = $port;
    $this->remote['password'] = $password;
    $this->remote['status'] = IRCCC_SYS_NOTCONNECTED;
    $this->user['name'] = $username;
    $this->user['nick'] = $nickname;
    $this->user['realname'] = $realname;
    $this->ctcp['clientinfo'] = "IRCCC " . IRCCC_VERSION . " (http://irccc.sourceforge.net/)";
    $this->ctcp['time'] = "D M j H:i:s";
    $this->ctcp['userinfo'] = "IRCCC " . IRCCC_VERSION . " (http://irccc.sourceforge.net/)";
    $this->ctcp['version'] = "IRCCC " . IRCCC_VERSION . " (http://irccc.sourceforge.net/)";

    // versuche zu verbinden
    $this->connect();
  }

  // member functions

  function action($rec,$message)
  {
    return $this->privmsg($rec,"\001ACTION " . $message . "\001");
  }

  function admin($server = "")
  {
    // TODO
  }

  function auditorium($channel,$activate = true)
  {
    if ($activate)
    {
      return $this->mode($channel,"+u");
    }
    else
    {
      return $this->mode($channel,"-u");
    }
  }

  function ban($channel,$banmask)
  {
    return $this->mode($channel,"+b",$banmask);
  }

  function ban_host($channel,$user)
  {
    return $this->ban($channel,"*!*@" . $this->mask2host($user));
  }

  function ban_ident($channel,$user)
  {
    $uhost = explode(".",$this->mask2host($user));
    $ucount = count($uhost);
    if ($ucount <= 2)
    {
      $banhost = $this->mask2host($user);
    }
    else
    {
      $banhost = "*." . $uhost[$ucount-2] . "." . $uhost[$ucount-1];
    }
    return $this->ban($channel,"*!" . $this->mask2us);
  }

  function ban_nick($channel,$user)
  {
    return $this->ban($channel,$this->mask2nick($user) . "!*@*");
  }

  function ban_user($channel,$user)
  {
    return $this->ban($channel,"*!" . $this->mask2user($user) . "@*");
  }

  function banlist($channel)
  {
    $this->mode($channel,"+b");
    $list = array();
    $this->readdata();
    if (count($this->buffer))
    {
      foreach ($this->buffer as $index => $line)
      {
        $type = $this->findtype($line);
        if ($type == IRCCC_RPL_BANLIST)
        {
          if (strtolower($this->findkey($line,IRCCC_RPL_BANLIST)) == strtolower($channel))
          {
            $tmpmsg = explode(" ",$line);
            $ban = array(
              "mask" => $tmpmsg[4],
              "nick" => $tmpmsg[5],
              "time" => $tmpmsg[6]
            );
            $list[] = $ban;
            unset($ban);
          }
        }
        elseif ($type == IRCCC_RPL_ENDOFBANLIST)
        {
          if (strtolower($this->findkey($line,IRCCC_RPL_ENDOFBANLIST)) == strtolower($channel))
          {
            unset ($this->buffer[$index]);
            break;
          }
        }
      }
    }
    return $list;
  }

  function bold($text)
  {
    return "\002" . $text . "\002";
  }

  function buffer_clear()
  {
    $oldbuffer = $this->buffer;
    $this->buffer = array();
    return $oldbuffer;
  }

  function chanlist($parameters = "")
  {
    $this->senddata(trim("LIST " . $parameters));
    $list = array();
    $this->readdata();
    if (count($this->buffer))
    {
      foreach ($this->buffer as $index => $line)
      {
        $type = $this->findtype($line);
        switch ($type)
        {
          case IRCCC_RPL_LISTSTART:
            unset($this->buffer[$index]);
            break;
          case IRCCC_RPL_LIST:
            $tmp = explode(" ",$line,6);
            $channel = array(
              "name" => $tmp[3],
              "users" => $tmp[4],
              "topic" => trim(substr($tmp[5],strpos($tmp[5],":")+1)),
            );
            $list[$tmp[3]] = $channel;
            unset($this->buffer[$index]);
            break;
          case IRCCC_RPL_LISTEND:
            unset($this->buffer[$index]);
            break 2;
        }
      }
    }
    return $list;
  }

  function connect()
  {
    if ($this->remote['status'] == IRCCC_SYS_NOTCONNECTED)
    {
      $this->remote['connection'] = fsockopen($this->remote['host'],
                                              $this->remote['port'],
                                              $errno,
                                              $errstr,
                                              10);
      if ($this->remote['connection'])
      {
        $this->remote['status'] = IRCCC_SYS_SENDINGNICK;
      }
      else
      {
        return IRCCC_SYS_NOTCONNECTED;
      }
    }

    if ($this->remote['status'] == IRCCC_SYS_SENDINGNICK)
    {
      $this->readdata();
      $this->pingcheck();
      $this->senddata("NICK " . $this->user['nick']);
      $this->remote['status'] = IRCCC_SYS_SENDINGUSER;
    }

    if ($this->remote['status'] == IRCCC_SYS_SENDINGUSER)
    {
      $this->senddata("USER " . $this->user['name'] . " * * :" . $this->user['realname']);
      usleep(50*1000);
      $this->readdata();
      $this->pingcheck();
      while (($this->remote['status'] != IRCCC_SYS_CONNECTED) and (!feof($this->remote['connection'])))
      {
        $this->readdata();
        $this->pingcheck();
        if (count($this->buffer))
        {
          foreach ($this->buffer as $key => $line)
          {
            if ($this->findtype($line) == "001")
            {
              $this->remote['status'] = IRCCC_SYS_CONNECTED;
              foreach ($this->buffer as $index => $line)
              {
                $tmp = explode(" ",$line);
                switch ($this->findtype($line))
                {
                  case "001":
                    $this->remote['welcome'] = trim($this->remote['welcome'] . "\n" . substr($tmp[3],1));
                    unset($this->buffer[$index]);
                    break;
                  case "002":
                    $this->remote['hostinfo'] = trim($this->remote['hostinfo'] . "\n" . substr($tmp[3],1));
                    unset($this->buffer[$index]);
                    break;
                  case "003":
                    $this->remote['serverstart'] = trim($this->remote['serverstart'] . "\n" . substr($tmp[3],1));
                    unset($this->buffer[$index]);
                    break;
                  case "004":
                    $this->remote['versioninfo'] = trim($this->remote['versioninfo'] . "\n" . $tmp[3]);
                    unset($this->buffer[$index]);
                    break;
                  case "005":
                    $tmp = explode(" ",$line,4);
                    $tmp = $tmp[3];
                    $tmp = substr($tmp,0,strrpos($tmp,":")-1);
                    $tmp = explode(" ",$tmp);
                    // $tmp is now a list of words after 005
                    foreach ($tmp as $setline)
                    {
                      $setting = explode("=",$setline);
                      if (!$setting[1])
                      {
                        $setting[1] = true;
                      }
                      $this->remote['settings'][$setting[0]] = $setting[1];
                    }
                    unset($this->buffer[$index]);
                    break;
                }
              }
              return IRCCC_SYS_CONNECTED;
            }
          }
        }
      }
    }
  }

  function ctcp_clientinfo($nick)
  {
    $this->privmsg($nick,"\001CLIENTINFO\001");
    $this->readdata();
    foreach ($this->buffer as $index => $line)
    {
      $type = $this->findtype($line);
      if ($type == "NOTICE")
      {
        $tmpmsg = $this->splitmessage($line);
        if ((strtolower($this->mask2nick($tmpmsg['from'])) == strtolower($nick)) and (substr(strtoupper($tmpmsg['message']),0,12) == "\001CLIENTINFO "))
        {
          unset($this->buffer[$index]);
          return substr($tmpmsg['message'],12,strlen($tmpmsg['message'])-13);
        }
      }
    }
  }

  function ctcp_ping($nick)
  {
    // TODO
  }

  function ctcp_time($nick)
  {
    $this->privmsg($nick,"\001TIME\001");
    $this->readdata();
    foreach ($this->buffer as $index => $line)
    {
      $type = $this->findtype($line);
      if ($type == "NOTICE")
      {
        $tmpmsg = $this->splitmessage($line);
        if ((strtolower($this->mask2nick($tmpmsg['from'])) == strtolower($nick)) and (substr(strtoupper($tmpmsg['message']),0,6) == "\001TIME "))
        {
          unset($this->buffer[$index]);
          return substr($tmpmsg['message'],6,strlen($tmpmsg['message'])-7);
        }
      }
    }
  }

  function ctcp_userinfo($nick)
  {
    $this->privmsg($nick,"\001USERINFO\001");
    $this->readdata();
    foreach ($this->buffer as $index => $line)
    {
      $type = $this->findtype($line);
      if ($type == "NOTICE")
      {
        $tmpmsg = $this->splitmessage($line);
        if ((strtolower($this->mask2nick($tmpmsg['from'])) == strtolower($nick)) and (substr(strtoupper($tmpmsg['message']),0,10) == "\001USERINFO "))
        {
          unset($this->buffer[$index]);
          return substr($tmpmsg['message'],10,strlen($tmpmsg['message'])-11);
        }
      }
    }
  }

  function ctcp_version($nick)
  {
    $this->privmsg($nick,"\001VERSION\001");
    $this->readdata();
    foreach ($this->buffer as $index => $line)
    {
      $type = $this->findtype($line);
      if ($type == "NOTICE")
      {
        $tmpmsg = $this->splitmessage($line);
        if ((strtolower($this->mask2nick($tmpmsg['from'])) == strtolower($nick)) and (substr(strtoupper($tmpmsg['message']),0,9) == "\001VERSION "))
        {
          unset($this->buffer[$index]);
          return substr($tmpmsg['message'],9,strlen($tmpmsg['message'])-10);
        }
      }
    }
  }

  function dehalfop($channel,$user)
  {
    return $this->mode($channel,"-h",$user);
  }

  function deop($channel,$user)
  {
    return $this->mode($channel,"-o",$user);
  }

  function deprotect($channel,$user)
  {
    return $this->mode($channel,"-a",$user);
  }

  function devoice($channel,$user)
  {
    return $this->mode($channel,"-v",$user);
  }

  function findkey($message,$type)
  {
    $field = explode(" ",$message);
    switch ($type)
    {
      case "INVITE":
      case "KICK":
      case "MODE":
      case "NOTICE":
      case "PART":
      case "PRIVMSG":
      case "TOPIC":
        $result = $field[2];
        break;
      case IRCCC_RPL_BANLIST:
      case IRCCC_RPL_ENDOFBANLIST:
      case IRCCC_RPL_ENDOFNAMES:
        $result = $field[3];
        break;
      case IRCCC_RPL_NAMREPLY:
      $result = $field[4];
        break;
      case "JOIN":
        $result = substr($field[2],1);
        break;
      case "NICK":
      case "QUIT":
        $result = "GENERAL";
        break;
    }
    return trim($result);
  }

  function findtype($message)
  {
    $tmp = explode(" ",$message);
    return strtoupper(trim($tmp[1]));
  }

  function get_remote_status()
  {
    return $this->remote['status'];
  }

  function globops($message)
  {
    // TODO
  }

  function halfop($channel,$user)
  {
    return $this->mode($channel,"+h",$user);
  }

  function hiddenhost($activate = true)
  {
    if ($activate)
    {
      return $this->mode($this->user['nick'],"+x");
    }
    else
    {
      return $this->mode($this->user['nick'],"-x");
    }
  }

  function hook_add($action,$key,$function)
  {
    $old = $this->hooks[$action][$key];
    $this->hooks[$action][$key][$function] = $function;
    return $old;
  }

  function hook_del($action,$key,$function)
  {
    unset($this->hooks[$action][$key][$function]);
    return $this->hooks[$action][$key];
  }

  function hook_run($action,$key,$data)
  {
    if ($this->hooks[$action][$key])
    {
      foreach ($this->hooks[$action][$key] as $function)
      {
        $function($data);
      }
      return true;
    }
    else
    {
      return false;
    }
  }

  function invisible($activate = true)
  {
    if ($activate)
    {
      return $this->mode($this->user['nick'],"+i");
    }
    else
    {
      return $this->mode($this->user['nick'],"-i");
    }
  }

  function invite($nick,$channel)
  {
    return $this->senddata("INVITE " . $nick . " " . $channel);
  }

  function inviteonly($channel,$activate = true)
  {
    if ($activate)
    {
      return $this->mode($channel,"+i");
    }
    else
    {
      return $this->mode($channel,"-i");
    }
  }

  function join($channel,$password = "")
  {
    if ($password)
    {
      return $this->senddata("JOIN " . $channel . " " . $password);
    }
    else
    {
      return $this->senddata("JOIN " . $channel);
    }
  }

  function key($channel,$key)
  {
    if ($key)
    {
      return $this->mode($channel,"+k",$key);
    }
    else
    {
      return $this->mode($channel,"-k");
    }
  }

  function kick($nick,$channel,$reason = "")
  {
    return $this->senddata("KICK " . $channel . " " . $nick . " :" . $reason);
  }

  function kill($nick,$reason)
  {
    if ($reason)
    {
      return $this->senddata("KILL " . $nick . " " . trim($reason));
    }
    else
    {
      return false;
    }
  }

  function knock($channel)
  {
    // TODO
  }

  function limit($channel,$limit)
  {
    if ($limit)
    {
      return $this->mode($channel,"+l",$limit);
    }
    else
    {
      return $this->mode($channel,"-l");
    }
  }

  function mask2host($mask)
  {
    return substr($mask,strpos($mask,"@")+1);
  }

  function mask2nick($mask)
  {
    return substr($mask,0,strpos($mask,"!"));
  }

  function mask2user($mask)
  {
    $expos = strpos($mask,"!");
    $atpos = strpos($mask,"@");
    return substr($mask,($expos+1),($atpos-$expos));
  }

  function me($rec,$message)
  {
    return $this->action($rec,$message);
  }

  function mode($target,$mode,$parameter = "")
  {
    if ($parameter)
    {
      return $this->senddata("MODE " . $target . " " . $mode . " " . $parameter);
    }
    else
    {
      return $this->senddata("MODE " . $target . " " . $mode);
    }
  }

  function moderated($channel,$activate = true)
  {
    if ($activate)
    {
      return $this->mode($channel,"+m");
    }
    else
    {
      return $this->mode($channel,"-m");
    }
  }

  function motd()
  {
    // TODO
  }

  function msg($rec,$message)
  {
    return $this->privmsg($rec,$message);
  }

  function names($channel)
  {
    $this->senddata("NAMES " . $channel);
    $list = array();
    $this->readdata();
    if (count($this->buffer))
    {
      foreach ($this->buffer as $index => $line)
      {
        $type = $this->findtype($line);
        if ($type == IRCCC_RPL_NAMREPLY)
        {
          if (strtolower($this->findkey($line,IRCCC_RPL_NAMREPLY)) == strtolower($channel))
          {
            $nickline = substr($line,strpos($line,":",1)+1);
            $nicks = explode(" ",$nickline);
            foreach ($nicks as $nick)
            {
              $list[] = $nick;
            }
            unset($this->buffer[$index]);
          }
        }
        elseif ($type == IRCCC_RPL_ENDOFNAMES)
        {
          if (strtolower($this->findkey($line,IRCCC_RPL_ENDOFNAMES)) == strtolower($channel))
          {
            unset($this->buffer[$index]);
            break;
          }
        }
      }
    }
    return $list;
  }

  function namesonly($channel)
  {
    $namesonly = array();
    $names = $this->names($channel);
    if (count($names))
    {
      foreach ($names as $name)
      {
        $char = substr($name,0,1);
        if (strpos($this->remote['settings']['STATUSMSG'],$char) === false)
        {
          $namesonly[] = $name;
        }
        else
        {
          $namesonly[] = substr($name,1);
        }
      }
    }
    return $namesonly;

  }

  function nick($newnick)
  {
    $this->senddata("NICK " . $newnick);
    return $this->user['nick'];
  }

  function notice($rec,$message)
  {
    return $this->senddata("NOTICE " . $rec . " :" . $message);
  }

  function op($channel,$user)
  {
    return $this->mode($channel,"+o",$user);
  }

  function oper($user,$password)
  {
    return $this->send("OPER " . $user . " " . $password);
  }

  function part($channel)
  {
    if (trim($channel))
    {
      $this->senddata("PART " . $channel);
      $this->readdata();
      if (count($this->buffer))
      {
        foreach ($this->buffer as $index => $line)
        {
          $tmp = explode(" ",$line);
          if (strtolower($tmp[3]) == strtolower($channel))
          {
            switch ($tmp[1])
            {
              case IRCCC_ERR_NOSUCHCHANNEL:
                unset($this->buffer[$index]);
                return IRCCC_ERR_NOSUCHCHANNEL;
                break;
              case IRCCC_ERR_NOTONCHANNEL:
                unset($this->buffer[$index]);
                return IRCCC_ERR_NOTONCHANNEL;
                break;
            }
          }
          elseif ((strtolower($tmp[2]) == strtolower($channel)) and ($tmp[1] == "PART"))
          {
            return true;
          }
        }
      }
    }
    else
    {
      return IRCCC_ERR_NEEDMOREPARAMS;
    }

  }

  function pingcheck()
  {
    if (count($this->buffer))
    {
      foreach($this->buffer as $index => $line)
      {
        if (strtoupper(substr($line,0,5)) == "PING ")
        {
          $this->senddata("PONG " . substr($line,5));
          unset($this->buffer[$index]);
        }
      }
    }
  }

//   function private($channel,$activate = true)
//   {
//     if ($activate)
//     {
//       return $this->mode($channel,"+p");
//     }
//     else
//     {
//       return $this->mode($channel,"-p");
//     }
//   }

  function privmsg($rec,$message)
  {
    return $this->senddata("PRIVMSG " . $rec . " :" . $message);
  }

  function protect($channel,$user)
  {
    return $this->mode($channel,"+a",$user);
  }

  function quit($reason = "")
  {
    $result = $this->senddata("QUIT :" . $reason);
    fclose($this->remote['connection']);
    $this->remote['status'] = 0;
    $this->run = false;
    return $result;
  }

  function quote($data)
  {
    return $this->senddata($data);
  }

  function raw($data)
  {
    return $this->senddata($data);
  }

  function readdata()
  {
    if ($this->remote['status'] != IRCCC_SYS_NOTCONNECTED)
    {
      socket_set_timeout($this->remote['connection'],0,100*1000);
      $linecount = 0;
      while ($line = fgets($this->remote['connection']))
      {
        $this->buffer[] = trim($line);
        // DEBUG BLOCK
        echo("->" . trim($line) . "\n");
        // END DEBUG BLOCK
        $linecount++;
      }
      return $linecount;
    }
    else
    {
      return false;
    }
  }

  function rules()
  {
    // TODO
  }

  function run()
  {
    if (feof($this->remote['connection']))
    {
      $this->run = false;
    }
    else
    {
      $this->buffer_clear();
      $this->hook_run("SYS","RUN","");
      $this->readdata();
      $this->pingcheck();
      if (count($this->buffer))
      {
        foreach ($this->buffer as $line)
        {
          $type = $this->findtype($line);
          $key = $this->findkey($line,$type);
          switch ($type)
          {
            case "INVITE":
              $this->hook_run("INVITE",$key,$line);
              break;
            case "JOIN":
              // chanliste anpassen
              $cmd = explode(" ",$line);
              if ($this->mask2nick(substr($cmd[0],1)) == $this->user['nick'])
              {
                $channel = trim(substr($cmd[2],1));
                $this->chanlist[$channel] = $channel;
              }
              // chanliste angepasst
              $this->hook_run("JOIN",$key,$line);
              $this->hook_run("USERLISTCHANGE",$key,$line);
              break;
            case "NICK":
              // nick anpassen und hooks aktualisieren
              $cmd = explode(" ",$line);
              $oldnick = $this->mask2nick(substr($cmd[0],1));
              if ($oldnick == $this->user['nick'])
              {
                $newnick = trim(substr($cmd[2],1));
                $this->user['nick'] = $newnick;
                foreach ($this->hooks as $type => $hooks)
                {
                  foreach ($hooks as $key => $functions)
                  {
                    if ($key == $oldnick)
                    {
                      unset($this->hooks[$type][$oldnick]);
                      $this->hooks[$type][$newnick] = $functions;
                    }
                  }
                }
              }
              // nick angepasst
              $this->hook_run("NICK",$key,$line);
              break;
            case "KICK":
              $this->hook_run("KICK",$key,$line);
              $this->hook_run("USERLISTCHANGE",$key,$line);
              break;
            case "MODE":
              $this->hook_run("MODE",$key,$line);
              break;
            case "NOTICE":
              $this->hook_run("NOTICE",$key,$this->splitmessage($line));
              $this->hook_run("MESSAGE",$key,$this->splitmessage($line));
              break;
            case "PART":
              // chanliste anpassen
              $cmd = explode(" ",$line);
              if ($this->mask2nick(substr($cmd[0],1)) == $this->user['nick'])
              {
                unset($this->chanlist[trim(substr($cmd[2],1))]);
              }
              // chanliste angepasst
              $this->hook_run("PART",$key,$line);
              $this->hook_run("USERLISTCHANGE",$key,$line);
              break;
            case "PRIVMSG":
              // check for ctcp requests
              $tmpmsg = $this->splitmessage($line);
              switch ($tmpmsg['message'])
              {
                case "\001CLIENTINFO\001":
                  $this->notice($this->mask2nick($tmpmsg['from']),"\001CLIENTINFO " . $this->ctcp['clientinfo'] . "\001");
                  break;
                case "\001TIME\001":
                  $this->notice($this->mask2nick($tmpmsg['from']),"\001TIME " . gmdate($this->ctcp['time']) . "\001");
                  break;
                case "\001USERINFO\001":
                  $this->notice($this->mask2nick($tmpmsg['from']),"\001USERINFO " . $this->ctcp['userinfo'] . "\001");
                  break;
                case "\001VERSION\001":
                  $this->notice($this->mask2nick($tmpmsg['from']),"\001VERSION " . $this->ctcp['version'] . "\001");
                  break;
                default:
                  $this->hook_run("PRIVMSG",$key,$tmpmsg);
                  $this->hook_run("MESSAGE",$key,$tmpmsg);
              }
              break;
            case "QUIT":
              $this->hook_run("QUIT",$key,$line);
              break;
            case "TOPIC":
              $this->hook_run("TOPIC",$key,$line);
              break;
          }
        }
      }
    }
  }

  function secret($channel,$activate = true)
  {
    if ($activate)
    {
      return $this->mode($channel,"+s");
    }
    else
    {
      return $this->mode($channel,"-s");
    }
  }

  function senddata($data)
  {
    if ($this->remote['status'] != IRCCC_SYS_NOTCONNECTED)
    {
      if (strlen($data) > 510)
      {
        $data = substr($data,0,510);
      }
      // DEBUG BLOCK
      echo("<-" . $data . "\n");
      // END DEBUG BLOCK
      return fputs($this->remote['connection'],$data . "\n");
    }
    else
    {
      return false;
    }
  }

  function splitmessage($message)
  {
    $result['plaintext'] = $message;
    if (preg_match('/^:([\S]+)\s([\S]+)\s((([\S]+)\s)?):(.*)$/is',$message,$matches))
    {
      $result['from'] = trim($matches[1]);
      $result['type'] = trim($matches[2]);
      $result['target'] = trim($matches[3]);
      $result['message'] = trim($matches[6]);
    }
    return $result;
  }

  function stay()
  {
    while ($this->run)
    {
      $this->run();
    }
  }

  function summon ()
  {
    // TODO
  }

  function topic($channel,$topic)
  {
    $this->senddata("TOPIC " . $channel . " " . trim($topic));
  }

  function topiclock($channel,$activate = true)
  {
    if ($activate)
    {
      return $this->mode($channel,"+t");
    }
    else
    {
      return $this->mode($channel,"-t");
    }
  }

  function umode($mode,$params = "")
  {
    return $this->mode($this->user['nick'],$mode,$params);
  }

  function unban($channel,$banmask)
  {
    return $this->mode($channel,"-b",$banmask);
  }

  function underline($text)
  {
    return "\037" . $text . "\037";
  }

  function underlined($text)
  {
    $this->underline($text);
  }

  function unoper()
  {
    return $this->mode($this->user['nick'],"-o");
  }

  function users()
  {
    // TODO
  }

  function voice($channel,$user)
  {
    return $this->mode($channel,"+v",$user);
  }

  function wallops($message)
  {
    // TODO
  }

  function whois($nick)
  {
    // TODO
  }
}

?>