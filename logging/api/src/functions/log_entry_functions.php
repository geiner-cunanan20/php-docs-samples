<?php
/**
 * Copyright 2016 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\Samples\Logging;

use Google\Cloud\Core\Iterator\ItemIterator;
// [START logging_use]
use Google\Cloud\Logging\LoggingClient;

// [END logging_use]

// [START write_log]
/** Write a log message via the Stackdriver Logging API.
 *
 * @param string $projectId The Google project ID.
 * @param string $loggerName The name of the logger.
 * @param string $message The log message.
 */
function write_log($projectId, $loggerName, $message)
{
    $logging = new LoggingClient(['projectId' => $projectId]);
    $logger = $logging->logger($loggerName);
    $entry = $logger->entry($message);
    $logger->write($entry);
}
// [END write_log]

// [START list_entries]
/** Return an iterator for listing log entries.
 *
 * @param string $projectId The Google project ID.
 * @param string $loggerName The name of the logger.
 * @return ItemIterator<Google\Cloud\Logging\Entry>
 */
function list_entries($projectId, $loggerName)
{
    $logging = new LoggingClient(['projectId' => $projectId]);
    $loggerFullName = sprintf('projects/%s/logs/%s', $projectId, $loggerName);
    $options = [
        'filter' => sprintf('logName = "%s"', $loggerFullName)
    ];
    return $logging->entries($options);
}
// [END list_entries]

// [START delete_logger]
/** Delete a logger and all its entries.
 *
 * @param string $projectId The Google project ID.
 * @param string $loggerName The name of the logger.
 */
function delete_logger($projectId, $loggerName)
{
    $logging = new LoggingClient(['projectId' => $projectId]);
    $logger = $logging->logger($loggerName);
    $logger->delete();
}
// [END delete_logger]
