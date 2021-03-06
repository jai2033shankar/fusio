<?php
/**
 * @var \Fusio\Engine\ConnectorInterface $connector
 * @var \Fusio\Engine\ContextInterface $context
 * @var \Fusio\Engine\RequestInterface $request
 * @var \Fusio\Engine\Response\FactoryInterface $response
 * @var \Fusio\Engine\ProcessorInterface $processor
 * @var \Psr\Log\LoggerInterface $logger
 * @var \Psr\SimpleCache\CacheInterface $cache
 */

use PSX\Http\Exception as StatusCode;

/** @var \Doctrine\DBAL\Connection $connection */
$connection = $connector->getConnection('Default-Connection');

$affected = $connection->update('app_todo', [
    'status' => 0,
], [
    'id' => $request->getUriFragment('todo_id')
]);

if (empty($affected)) {
    throw new StatusCode\NotFoundException('Entry not available');
}

return $response->build(200, [], [
    'success' => true,
    'message' => 'Delete successful',
]);
