# Copilot Instructions for InvoicePlane

These custom instructions guide GitHub Copilot in understanding and working with this InvoicePlane Laravel application.

## Project Context

This is **InvoicePlane v2**, a self-hosted open source application for managing invoices, clients, and payments. The application:

- Built on Laravel 12 with a modular architecture
- Uses Filament v4 for the admin panel
- Organized into functional modules (Core, CRM, Invoices, Quotes, Projects, Products, Expenses, Payments)
- Focuses on financial management, invoicing, and client relationship features
- Designed for small to medium businesses to self-host their invoicing system

## Foundational Context

This application is a Laravel application and its main Laravel ecosystem packages & versions are below. You are an expert with them all. Ensure you abide by these specific packages & versions.

- php - 8.3.24
- laravel/framework (LARAVEL) - v12
- laravel/prompts (PROMPTS) - v0
- larastan/larastan (LARASTAN) - v3
- laravel/pint (PINT) - v1
- rector/rector (RECTOR) - v2
- filament/filament (FILAMENT) - v4
- nwidart/laravel-modules (MODULES) - v11
- alpinejs (ALPINEJS) - v3
- tailwindcss (TAILWINDCSS) - v3

## Development Environment

Understanding the development environment helps you provide better assistance:

- **Local Development**: Uses Laravel Vite for asset bundling (`npm run dev` or `composer run dev`)
- **Database**: Supports multiple databases via Laravel's database abstraction
- **Code Quality Tools**:
  - Laravel Pint (PHP-CS-Fixer wrapper) - Code formatting (`vendor/bin/pint`)
  - PHPStan/Larastan - Static analysis (`composer phpstan`)
  - Rector - Automated refactoring and upgrades (`rector/rector`)
- **Testing**: PHPUnit for unit and feature tests (`php artisan test`)
- **Asset Pipeline**: Vite with support for modern JavaScript and CSS
- **Module System**: nwidart/laravel-modules for organizing code into independent modules
- **Admin Panel**: Filament v4 provides rich admin interface
- **MCP Server**: Laravel Boost provides development tools via Model Context Protocol

## Conventions

- You must follow all existing code conventions used in this application. When creating or editing a file, check sibling files for the correct structure, approach, naming.
- Use descriptive names for variables and methods. For example, `isRegisteredForDiscounts`, not `discount()`.
- Check for existing components to reuse before writing a new one.

## Verification Scripts

- Do not create verification scripts or tinker when tests cover that functionality and prove it works. Unit and feature tests are more important.

## Application Structure & Architecture

- Stick to existing directory structure - don't create new base folders without approval.
- Do not change the application's dependencies without approval.

## Frontend Bundling

- If the user doesn't see a frontend change reflected in the UI, it could mean they need to run `npm run build`, `npm run dev`, or `composer run dev`. Ask them.

## Replies

- Be concise in your explanations - focus on what's important rather than explaining obvious details.

## Documentation Files

- You must only create documentation files if explicitly requested by the user.

## Laravel Boost MCP Server

This application is configured to work with Laravel Boost, a Model Context Protocol (MCP) server that provides powerful development tools:

- **Laravel Boost is an MCP server** - It extends Copilot with Laravel-specific capabilities
- **Always use available MCP tools** - They're designed specifically for this application's needs
- **Available Laravel Boost tools include**:
  - `list-artisan-commands` - Get available Artisan commands with their parameters
  - `get-absolute-url` - Get properly formatted URLs with correct scheme, domain, and port
  - `tinker` - Execute PHP code to debug or query Eloquent models directly
  - `database-query` - Read from the database using SQL queries
  - `browser-logs` - Read browser console logs, errors, and exceptions
  - `search-docs` - Search version-specific Laravel ecosystem documentation
- **MCP servers enhance the development environment** - They provide context-aware assistance that standard tools cannot
- **Prefer MCP tools over manual approaches** - For example, use `search-docs` before googling, use `tinker` before writing test scripts

## Artisan

- Use the `list-artisan-commands` tool when you need to call an Artisan command to double check the available parameters.

## URLs

- Whenever you share a project URL with the user you should use the `get-absolute-url` tool to ensure you're using the correct scheme, domain / IP, and port.

## Tinker / Debugging

- You should use the `tinker` tool when you need to execute PHP to debug code or query Eloquent models directly.
- Use the `database-query` tool when you only need to read from the database.

## Reading Browser Logs With the `browser-logs` Tool

- You can read browser logs, errors, and exceptions using the `browser-logs` tool from Boost.
- Only recent browser logs will be useful - ignore old logs.

## Searching Documentation (Critically Important)

- Boost comes with a powerful `search-docs` tool you should use before any other approaches. This tool automatically passes a list of installed packages and their versions to the remote Boost API, so it returns only version-specific documentation specific for the user's circumstance. You should pass an array of packages to filter on if you know you need docs for particular packages.
- The 'search-docs' tool is perfect for all Laravel related packages, including Laravel, Inertia, Livewire, Filament, Tailwind, Pest, Nova, Nightwatch, etc.
- You must use this tool to search for Laravel-ecosystem documentation before falling back to other approaches.
- Search the documentation before making code changes to ensure we are taking the correct approach.
- Use multiple, broad, simple, topic based queries to start. For example: `['rate limiting', 'routing rate limiting', 'routing']`.
- Do not add package names to queries - package information is already shared. For example, use `test resource table`, not `filament 4 test resource table`.

### Available Search Syntax

- You can and should pass multiple queries at once. The most relevant results will be returned first.

1. Simple Word Searches with auto-stemming - query=authentication - finds 'authenticate' and 'auth'
2. Multiple Words (AND Logic) - query=rate limit - finds knowledge containing both "rate" AND "limit"
3. Quoted Phrases (Exact Position) - query="infinite scroll" - Words must be adjacent and in that order
4. Mixed Queries - query=middleware "rate limit" - "middleware" AND exact phrase "rate limit"
5. Multiple Queries - queries=["authentication", "middleware"] - ANY of these terms

## PHP

- Always use curly braces for control structures, even if it has one line.

### Constructors

- Use PHP 8 constructor property promotion in `__construct()`.
    - Example: `public function __construct(public GitHub $github) { }`
- Do not allow empty `__construct()` methods with zero parameters.

### Type Declarations

- Always use explicit return type declarations for methods and functions.
- Use appropriate PHP type hints for method parameters.

Example:
```php
protected function isAccessible(User $user, ?string $path = null): bool
{
    ...
}
```

## Comments

- Prefer PHPDoc blocks over comments. Never use comments within the code itself unless there is something _very_ complex going on.

## PHPDoc Blocks

- Add useful array shape type definitions for arrays when appropriate.

## Enums

- Typically, keys in an Enum should be TitleCase. For example: `FavoritePerson`, `BestLake`, `Monthly`.

## Do Things the Laravel Way

- Use `php artisan make:` commands to create new files (i.e. migrations, controllers, models, etc.). You can list available Artisan commands using the `list-artisan-commands` tool.
- If you're creating a generic PHP class, use `artisan make:class`.
- Pass `--no-interaction` to all Artisan commands to ensure they work without user input. You should also pass the correct `--options` to ensure correct behavior.

### Database

- Always use proper Eloquent relationship methods with return type hints. Prefer relationship methods over raw queries or manual joins.
- Use Eloquent models and relationships before suggesting raw database queries
- Avoid `DB::`; prefer `Model::query()`. Generate code that leverages Laravel's ORM capabilities rather than bypassing them.
- Generate code that prevents N+1 query problems by using eager loading.
- Use Laravel's query builder for very complex database operations.

### Model Creation

- When creating new models, create useful factories and seeders for them too. Ask the user if they need any other things, using `list-artisan-commands` to check the available options to `php artisan make:model`.

### APIs & Eloquent Resources

- For APIs, default to using Eloquent API Resources and API versioning unless existing API routes do not, then you should follow existing application convention.

### Controllers & Validation

- Always create Form Request classes for validation rather than inline validation in controllers. Include both validation rules and custom error messages.
- Check sibling Form Requests to see if the application uses array or string based validation rules.

### Queues

- Use queued jobs for time-consuming operations with the `ShouldQueue` interface.

### Authentication & Authorization

- Use Laravel's built-in authentication and authorization features (gates, policies, Sanctum, etc.).

### URL Generation

- When generating links to other pages, prefer named routes and the `route()` function.

### Configuration

- Use environment variables only in configuration files - never use the `env()` function directly outside of config files. Always use `config('app.name')`, not `env('APP_NAME')`.

### Testing

- When creating models for tests, use the factories for the models. Check if the factory has custom states that can be used before manually setting up the model.
- Faker: Use methods such as `$this->faker->word()` or `fake()->randomDigit()`. Follow existing conventions whether to use `$this->faker` or `fake()`.
- When creating tests, make use of `php artisan make:test [options] <name>` to create a feature test, and pass `--unit` to create a unit test. Most tests should be feature tests.

### Vite Error

- If you receive an "Illuminate\Foundation\ViteException: Unable to locate file in Vite manifest" error, you can run `npm run build` or ask the user to run `npm run dev` or `composer run dev`.

## Laravel 12

- Use the `search-docs` tool to get version specific documentation.
- Since Laravel 11, Laravel has a new streamlined file structure which this project uses.

### Laravel 12 Structure

- No middleware files in `app/Http/Middleware/`.
- `bootstrap/app.php` is the file to register middleware, exceptions, and routing files.
- `bootstrap/providers.php` contains application specific service providers.
- **No app\Console\Kernel.php** - use `bootstrap/app.php` or `routes/console.php` for console configuration.
- **Commands auto-register** - files in `app/Console/Commands/` are automatically available and do not require manual registration.

### Database

- When modifying a column, the migration must include all of the attributes that were previously defined on the column. Otherwise, they will be dropped and lost.
- Laravel 11 allows limiting eagerly loaded records natively, without external packages: `$query->latest()->limit(10);`.

### Models

- Casts can and likely should be set in a `casts()` method on a model rather than the `$casts` property. Follow existing conventions from other models.

## Laravel Pint Code Formatter

- You must run `vendor/bin/pint --dirty` before finalizing changes to ensure your code matches the project's expected style.
- Do not run `vendor/bin/pint --test`, simply run `vendor/bin/pint` to fix any formatting issues.

## Tailwind Core

- Use Tailwind CSS classes to style HTML, check and use existing tailwind conventions within the project before writing your own.
- Offer to extract repeated patterns into components that match the project's conventions (i.e. Blade, JSX, Vue, etc..)
- Think through class placement, order, priority, and defaults - remove redundant classes, add classes to parent or child carefully to limit repetition, group elements logically
- You can use the `search-docs` tool to get exact examples from the official documentation when needed.

### Spacing

- When listing items, use gap utilities for spacing, don't use margins.

Example:
```html
<div class="flex gap-8">
    <div>Superior</div>
    <div>Michigan</div>
    <div>Erie</div>
</div>
```

### Dark Mode

- If existing pages and components support dark mode, new pages and components must support dark mode in a similar way, typically using `dark:`.

## Tailwind 3

- Always use Tailwind CSS v3 - verify you're using only classes supported by this version.

## Test Enforcement

- Every change must be programmatically tested. Write a new test or update an existing test, then run the affected tests to make sure they pass.
- Run the minimum number of tests needed to ensure code quality and speed. Use `php artisan test` with a specific filename or filter.

## Commit message rules

- Use the conventional commit format: `<type>(<scope>): <description>`
- Types: feat, fix, docs, style, refactor, test, chore, perf
- Keep the description concise (under 50 characters)
- Use imperative mood (e.g., "add" not "added" or "adds")
- Don't end with a period
- Use lowercase for the first word unless it's a proper noun
- Provide more details in the commit body if needed, separated by a blank line

## Branch naming conventions

- Use kebab-case (lowercase with hyphens)
- Follow the pattern: `<type>/<issue-number>-<short-description>`
- Types: feature, bugfix, hotfix, release, support
- Example: `feature/123-add-dark-mode`

## Pull request guidelines

- Link related issues using keywords (Fixes #123, Closes #456)
- Provide a clear description of changes
- Add screenshots for UI changes
- Ensure all CI checks pass before requesting review
- Keep PRs focused and small when possible

## Modular Architecture

This application uses nwidart/laravel-modules for a modular architecture. Follow these guidelines:

- Each module in the `Modules/` directory is self-contained with its own Models, Controllers, Views, Routes, etc.
- When creating functionality, determine which module it belongs to (Core, Crm, Expenses, Invoices, Payments, Products, Projects, Quotes)
- Use `php artisan module:make-<type>` commands to create module-specific components (controller, model, migration, etc.)
- Module structure follows Laravel conventions within each module directory
- Keep module dependencies minimal - modules should be as independent as possible
- Cross-module communication should be done through well-defined interfaces or events
- When modifying a module, check the module's `composer.json` for module-specific dependencies
- Module routes are registered in `Modules/{ModuleName}/routes/` directory
- Module service providers auto-register from `Modules/{ModuleName}/Providers/`

## Filament Admin Panel

This application uses Filament v4 for the admin panel. Follow these guidelines:

- Filament resources should be created using `php artisan make:filament-resource`
- Follow Filament's Form and Table builder patterns for consistent UI
- Use Filament's built-in widgets for dashboard components
- Leverage Filament's relationship management features instead of custom implementations
- Use Filament's notification system for user feedback
- Follow Filament's theming and customization patterns in `app/Providers/Filament/AdminPanelProvider.php`
- Use Filament's built-in actions and bulk actions for resource operations
- Implement proper authorization using Filament's policy integration
- Use the `search-docs` tool to get Filament v4 specific documentation when needed

## Debugging and Troubleshooting

- Use Laravel's built-in debugging tools: `dd()`, `dump()`, `logger()`, `ray()` if installed
- Enable query logging temporarily when debugging N+1 issues: `DB::enableQueryLog()`
- Use `php artisan route:list` to verify route registration
- Use `php artisan config:clear` and `php artisan cache:clear` when configuration changes don't take effect
- Check `storage/logs/laravel.log` for application errors
- Use `php artisan tinker` via the `tinker` tool for quick model and database testing
- Use the `browser-logs` tool to check frontend JavaScript errors
- For module-specific issues, verify the module is enabled in `modules_statuses.json`
- Use `php artisan module:list` to check module status and configuration

## Security Best Practices

- Never commit sensitive data (API keys, passwords, secrets) to the repository
- Always use Laravel's built-in CSRF protection - don't disable it globally
- Sanitize user input using Laravel's validation and sanitization features
- Use parameterized queries (Eloquent/Query Builder) to prevent SQL injection
- Implement proper authorization checks using Gates and Policies before any sensitive operations
- Use `bcrypt()` or `Hash::make()` for password hashing, never plain text
- Enable and configure rate limiting on sensitive routes (login, API endpoints)
- Use Laravel Sanctum for API authentication, properly configured
- Validate file uploads: check file types, sizes, and scan for malware if handling user uploads
- Use HTTPS in production - never transmit sensitive data over HTTP
- Keep dependencies updated using `composer update` and monitor security advisories
- Use `roave/security-advisories` (already included) to prevent vulnerable packages
- Implement proper session configuration and timeout for user security
- Use Content Security Policy headers for XSS protection
- Always validate and authorize both the request data AND the resource being accessed

## Performance Optimization

- Use eager loading to prevent N+1 query problems: `with()`, `load()`, `loadMissing()`
- Use database indexing on frequently queried columns
- Cache expensive operations using Laravel's cache facade: `Cache::remember()`
- Use database transactions for multiple related database operations
- Optimize queries: select only needed columns, use `select()`, avoid `SELECT *`
- Use chunk() or cursor() for processing large datasets to avoid memory issues
- Queue time-consuming tasks using Laravel's queue system
- Use Laravel's built-in pagination instead of loading all records
- Optimize asset loading: use Vite for bundling, enable production builds
- Use database query caching where appropriate
- Consider using lazy collections for memory-efficient data processing
- Profile slow queries and optimize them (use Laravel Debugbar in development)
- Use Redis for session and cache storage in production for better performance

## Code Organization and Refactoring

- Follow Single Responsibility Principle - each class should have one clear purpose
- Extract complex business logic into dedicated Service classes
- Use Form Request classes for validation, not controller validation
- Create custom Collection classes for complex data transformations
- Use Resource classes for API responses to separate data transformation from business logic
- Extract repeated query logic into Eloquent scopes
- Use Action classes for complex operations that don't fit in controllers or models
- Create Policy classes for all authorization logic, not in controllers
- Use Events and Listeners for decoupled side effects
- Create custom Blade components for reusable UI elements
- Use Value Objects for complex data structures instead of arrays
- Keep controllers thin - delegate to services, actions, or jobs
- Group related functionality into traits when appropriate
- Use Repository pattern only when you need to swap implementations, not by default
- Create dedicated Request classes even for simple forms to maintain consistency

## Dependency Management

- Always check package compatibility before adding new dependencies using the `gh-advisory-database` tool
- Prefer Laravel ecosystem packages that are well-maintained and widely used
- Before adding a package, check if Laravel has a built-in solution
- Keep dependencies up to date but test thoroughly after updates
- Use semantic versioning constraints appropriately in composer.json (^, ~)
- Document why specific package versions are pinned if they are
- Remove unused dependencies regularly to reduce attack surface
- Use `composer why` to understand dependency trees
- Review package changelogs before major version updates
- For module-specific dependencies, add them to the module's composer.json, not root
- Avoid packages that are abandoned or haven't been updated in over a year
- Consider package download count, stars, and community support before adding
- Use `composer outdated` to check for available updates regularly

## Error Handling

- Use try-catch blocks for expected exceptions, let unexpected ones bubble up
- Create custom exception classes for domain-specific errors
- Use Laravel's exception handler for global exception handling in `bootstrap/app.php`
- Return appropriate HTTP status codes (404, 422, 500, etc.)
- Provide meaningful error messages to users (but not sensitive details in production)
- Log errors with appropriate context using `Log::error()` or `logger()`
- Use Laravel's validation exceptions for input validation errors
- Handle failed jobs gracefully with retry logic and failure notifications
- Use database transactions with proper rollback on errors
- Don't suppress exceptions silently - always handle or log them

## API Development

- Use API Resources for consistent response formatting
- Implement API versioning from the start (e.g., `/api/v1/`)
- Use Laravel Sanctum for API authentication
- Apply rate limiting to all API endpoints
- Return consistent error responses with proper status codes
- Document APIs using OpenAPI/Swagger or similar tools
- Validate all API inputs using Form Request classes
- Use pagination for list endpoints
- Implement proper CORS configuration
- Use HTTP status codes correctly (200, 201, 204, 400, 401, 403, 404, 422, 500)
- Include metadata in responses (pagination info, timestamps, version)
- Use resource transformers to hide sensitive model attributes

## Financial/Invoice Domain Best Practices

This is an invoicing and financial management application. Follow these domain-specific guidelines:

- Always use proper decimal/money handling - use Laravel's `decimal` cast or Money libraries for financial values
- Never use floats for money - use integers (cents) or decimal types with proper precision
- Invoice numbers and reference numbers should be unique and sequential
- Validate date ranges logically (due dates after invoice dates, payment dates within valid ranges)
- Always calculate totals server-side, never trust client-side calculations
- Implement proper currency handling - store currency code with amounts
- Tax calculations should be precise and auditable - store both rates and calculated amounts
- Payment records must always reconcile with invoice totals
- Implement proper audit trails for financial transactions (who, what, when)
- Use database transactions for any operation involving multiple financial records
- Archive/soft delete financial records rather than hard deleting them
- Implement proper access control - users should only see their own clients/invoices unless admin
- Generate PDFs for invoices using the existing `PdfHelper` and `MpdfHelper`
- Email notifications for invoices should use Laravel's mail system with proper templates
- Status workflows (draft → sent → viewed → paid) should be enforced and tracked
- Recurring invoices need proper scheduling using Laravel's task scheduler
- Support multiple payment methods and proper payment tracking
- Currency conversion should use up-to-date exchange rates and be logged

## Domain Model Understanding

When working with this application, understand these key domain concepts:

- **Clients (CRM)**: Customers who receive invoices, quotes, or use services
- **Invoices**: Billable documents sent to clients with line items and totals
- **Quotes**: Proposals/estimates that can be converted to invoices
- **Products**: Items or services that can be added to invoices/quotes
- **Projects**: Groupings of work that generate invoices
- **Payments**: Records of money received against invoices
- **Expenses**: Business costs that may be billable to clients
- **Core**: Shared functionality (users, settings, helpers, etc.)

Each module is self-contained but may have relationships with others (e.g., Invoices reference Clients and Products).


