# Analytics Events Specification

This document outlines the Google Analytics 4 (GA4) events and Google Tag Manager (GTM) triggers to be implemented on the iSwift website. Replace the placeholder GA4 and GTM IDs in the code with the actual IDs before launch.

## Global Tags

* Insert the GA4 and GTM snippets into the `<head>` of the site via `partials/header.php`.
* Use placeholder IDs (e.g. `G‑XXXXXXXXXX` and `GTM-XXXXXXX`) until the real IDs are provided.

## Recommended Events

| Event Name | Trigger | Parameters | Notes |
|-----------|---------|------------|------|
| `page_view` | Fired on every page load | `page_location`, `page_referrer`, `page_title` | Standard GA4 page view event. |
| `select_content` | When a user clicks a solution/product/project card | `content_type` (e.g. `solution`, `product`, `project`), `item_id` (slug) | Helps measure interest in different content types. |
| `book_demo` | When the demo booking form is successfully submitted | `city`, `project_type` | Trigger after form validation. |
| `contact_form_submit` | When the contact form is submitted | `name`, `email` (optional) | Use to measure enquiries. |
| `outbound_click` | When a user clicks an external link (e.g. WhatsApp, social links) | `link_url` | Use GTM auto‑link tracking if available. |
| `video_play` | When a video (if any) starts playing | `video_title`, `video_duration` | Use if product pages include demo videos. |
| `search` | When a user performs a product search (via search input on products page) | `search_term` | Measures demand for specific product queries. |

## Implementation Notes

1. **GTM Integration**: Add GTM script in the `<head>` of `partials/header.php`. Configure GA4 via GTM and create triggers for the above events.
2. **Form Submission Events**: Use JavaScript to push events to the `dataLayer` upon successful AJAX form submission (e.g. `book_demo` and `contact_form_submit`).
3. **Outbound Link Tracking**: Implement a small script to detect clicks on links with `target="_blank"` and push an `outbound_click` event with the URL.
4. **Privacy Compliance**: Ensure that no personally identifiable information (PII) is sent to GA4. Use anonymized or aggregate data for analytics.