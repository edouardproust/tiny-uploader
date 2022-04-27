# tiny uploader

The most simple and clean upload system for Symfony apps.

## Key files:

- Entity: `src/Entity/Upload.php`
- Service: `src/Service/UploadService.php`
- Form type: `src/Form/UploadType.php`
- Event listener: `src/EventListener/UploadListener.php`
- Settings: `src/config/services.yaml` (auto-wire arguments to service and form type, and register event listener)

## Optional

- Additional settings for template: `src/config/packages/twig.yaml`