<?php

namespace Example\Blt\Plugin\Commands;


use Acquia\Blt\Robo\BltTasks;

/**
 * Defines commands in the "custom" namespace.
 */
class ConvertTimeZoneCommand extends BltTasks
{

  /**
   * Executes the custom command.
   *
   * @command custom:timezone
   * 
   * @param string $timezone Timezone abbreviation (e.g., UTC, JST).
   * @param array $options
   * @option $format Format of the displayed time.
   *
   * @throws \Exception
   */
  public function customCommand($timezone, $options = ['format' => 'Y-m-d h:i:s a'])
  {
    try {
      date_default_timezone_set("Asia/Calcutta");
      $currentTime = new \DateTime('now', new \DateTimeZone(date_default_timezone_get()));

      // Display the current time in the server's timezone
      $this->say("Current time in your timezone: " . $currentTime->format($options['format']));

      // Display the converted time to the user-specified timezone
      $currentTime->setTimezone(new \DateTimeZone($timezone));
      $this->say("Converted time in {$timezone}: " . $currentTime->format($options['format']));
    } catch (\Exception $e) {
      $this->say('An error occurred: ' . $e->getMessage());
    }
  }
}
