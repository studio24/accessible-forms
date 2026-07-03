# Changelog

All notable changes to accessible-forms will be documented in this file.

## [0.1.5](https://github.com/studio24/accessible-forms/compare/v0.1.4...v0.1.5) (2026-07-03)


### Bug Fixes

* Parse HTML correctly when not using a view on custom HTML block. ([900b790](https://github.com/studio24/accessible-forms/commit/900b7909abb8032c06ea27dcbeb620d43d420e4e))
* restored previous fieldset configuration but with widget_container_attributes. ([1bf6bb8](https://github.com/studio24/accessible-forms/commit/1bf6bb8186701e9651a6947da248569daffc2f9f))

## [0.1.4](https://github.com/studio24/accessible-forms/compare/v0.1.3...v0.1.4) (2026-06-17)


### Bug Fixes

* Added missing error class for checkbox validation errors. ([425c9c2](https://github.com/studio24/accessible-forms/commit/425c9c23681e55f33f605939c207408f89dea91f))
* Append _0 to error ID on checkbox and radio button groups, so that the error link jumps to the first input element instead of the surrounding block. ([3f4254a](https://github.com/studio24/accessible-forms/commit/3f4254a0f34c0a17d32313f63e300d30afe04f2d))
* Disabled mapping by default on custom HTML block. ([b34e0de](https://github.com/studio24/accessible-forms/commit/b34e0deedcbc952d19d281ccac35327d85398b81))
* Fixed issue with multiple errors for a single field being grouped onto one. ([b400ca0](https://github.com/studio24/accessible-forms/commit/b400ca00f613ca8bb2bd1fdf86e088698b44563c))

## [0.1.3](https://github.com/studio24/accessible-forms/compare/v0.1.3...v0.1.4) (2026-04-10)

### Bug Fixes

* Set mapped to false by default for custom Html block type, to prevent the need to do so manually.
* Moved choice fieldset element from form_row_render to choice_widget_expanded to allow checkbox attributes to be added to fieldset. (solves issue where screen readers were not announcing errors on checkbox/radio focus)
* Fixed multiple validation errors for one field being listed as one error and appended to the same string.
* Appended _0 to the error block so that the first checkbox/radio is highlighted when clicking the error summary anchor.


## [0.1.3](https://github.com/studio24/accessible-forms/compare/v0.1.2...v0.1.3) (2026-04-10)

### Bug Fixes

* Singular phrasing on error block where there is only 1 error.

### Added

* New Html form type for including custom HTML in a form.


## [0.1.2](https://github.com/studio24/accessible-forms/compare/v0.1.1...v0.1.2) (2026-01-14)


### Bug Fixes

* Fixed incorrect help and error IDs to match aria-describedby values. ([553731e](https://github.com/studio24/accessible-forms/commit/553731e2504ef856fa2b13f03dd6989c66383c24))

## [0.1.1](https://github.com/studio24/accessible-forms/compare/v0.1.0...v0.1.1) (2025-12-12)


### Bug Fixes

* fix form_all_errors_count Twig function ([6a5c14e](https://github.com/studio24/accessible-forms/commit/6a5c14ea227a04206dc59a3270ee328b69e40a45))

## 0.1.1 (2025-12-12)

Initial release
