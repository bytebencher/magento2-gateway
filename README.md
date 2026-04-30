# ByteBencher Gateway for Magento 2

`ByteBencher_Gateway` is a reusable Magento 2 foundation module for building integrations with external REST and SOAP services. It provides the common plumbing for request building, transport creation, client execution, response handling, validation, error mapping, and logging so project-specific gateway modules can focus on business rules.

## Features

- Magento 2 module registration under `ByteBencher_Gateway`
- PHP namespace root `ByteBencher\Gateway`
- Support for REST, SOAP, and Guzzle-based HTTP clients
- Config-driven production and sandbox credentials
- Command pool and gateway adapter abstractions
- Request builder composites for assembling API payloads
- Response handlers, validators, and result objects
- Error message mapping support
- Debug logging with sensitive field masking
- Stub XML files to speed up downstream module setup

## Requirements

- PHP `~7.4` or `~8.1`
- Magento framework `~103.0`
- PHP extensions: `ext-json`, `ext-soap`

## Installation

Install the package with Composer:

```bash
composer require bytebencher/magento2-gateway
```

Enable the module in Magento:

```bash
bin/magento module:enable ByteBencher_Gateway
bin/magento setup:upgrade
bin/magento cache:flush
```

## Package metadata

- Composer package: `bytebencher/magento2-gateway`
- Magento module name: `ByteBencher_Gateway`
- Root PHP namespace: `ByteBencher\Gateway`

## What this module provides

This package is a base layer, not a complete end-user integration by itself. It gives you reusable building blocks for a custom gateway module:

- **Gateway adapter**: coordinates command execution.
- **Command pool**: resolves command instances by code.
- **Commands**: build requests, execute HTTP clients, validate responses, and trigger handlers.
- **Builders**: prepare request data such as endpoints, credentials, headers, store context, and request method.
- **Transfer objects**: standardize the data passed to the HTTP client.
- **HTTP clients**: send REST, SOAP, or Guzzle requests.
- **Validators**: verify remote responses and return structured results.
- **Handlers and data modifiers**: process successful responses and enrich result data.
- **Error mapper**: convert external error codes to customer-friendly messages.
- **Logger**: writes debug information while masking configured sensitive fields.

## Configuration model

The default configuration alias used by the module is `bbgateway`, so values are generally stored under:

- `bbgateway/general/*`
- `bbgateway/gateway/*`

Important configuration values include:

- `active`
- `mode`
- `api_username_production`
- `api_username_sandbox`
- `api_password_production`
- `api_password_sandbox`
- `api_endpoint_production`
- `api_endpoint_sandbox`
- `http_client`
- `debug`

Available mode values:

- `1` = Production
- `2` = Sandbox

Available HTTP client values:

- `1` = REST
- `2` = SOAP
- `3` = Guzzle

## Files you will commonly extend

- `etc/di.xml`
- `etc/adminhtml/system-stub.xml`
- `etc/config-stub.xml`
- `Model/GatewayAdapter.php`
- `Model/Command/GatewayCommand.php`
- `Model/Config/Config.php`

## Typical integration workflow

1. Create your own Magento module that depends on `ByteBencher_Gateway`.
2. Copy and adapt the stub configuration files for your module's admin settings and defaults.
3. Define a gateway adapter and command pool entries in your module `di.xml`.
4. Create request builders for the external service contract.
5. Select the proper HTTP client type for the target API.
6. Add validators to detect and normalize remote API failures.
7. Add handlers or data modifiers to map successful responses into Magento workflows.
8. Configure credentials, endpoints, and debug mode per environment.

## Using the stub XML files

The repository includes two stub files intended for reuse in implementation modules:

- `etc/adminhtml/system-stub.xml`
- `etc/config-stub.xml`

Use them as templates when creating:

- admin configuration sections and fields
- default configuration values for your integration
- mode switching between sandbox and production
- API credential and endpoint storage

Replace placeholder values such as `YOUR_TAB_NAME`, `YOUR_SECTION_NAME`, and `YOUR_MODULE::RESOURCE` with values from your own module.

## Dependency injection conventions

The default DI configuration defines shared base services and virtual types for:

- command pools
- abstract gateway commands
- request builder composites
- response handler chains
- response data modifier chains
- loggers
- HTTP client converters

When creating a real integration, add your own virtual types and inject project-specific builders, validators, handlers, and mapper implementations.

## Logging

Debug logging is routed through `ByteBencher\Gateway\Model\Logger`.

Behavior to know:

- debug logging can be toggled via configuration
- selected keys can be masked before logging
- response-processing errors are logged before command exceptions are thrown
- the default logger channel name is `bbgateway`

## Publishing to Packagist

This repository is now prepared to publish under the `bytebencher/magento2-gateway` package name. Before publishing a new release, verify:

1. the desired tag exists in the repository
2. the `composer.json` metadata matches the release intent
3. the README reflects the public installation and usage flow
4. the published branch contains the renamed `ByteBencher_Gateway` module identifiers

## Support

- Documentation: this README
- Issue tracker: https://github.com/bytebencher/magento2-gateway/issues
- Source: https://github.com/bytebencher/magento2-gateway
