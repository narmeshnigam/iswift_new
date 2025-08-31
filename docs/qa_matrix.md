# QA Matrix

The following matrix summarises the manual QA performed on the refreshed iSwift website. Each test case was executed on Chrome (desktop and mobile), Firefox and Safari. Mobile testing was simulated via responsive mode in Chrome DevTools.

| Page/Feature | Test | Expected Result | Outcome (Pass/Fail) | Notes |
| --- | --- | --- | --- | --- |
| Home page | Load in Chrome/Firefox/Safari | Page loads without errors; hero, solutions preview and CTA sections display correctly; header/footer responsive | Pass | – |
| Navigation menu | Click each nav item on desktop | Links navigate to corresponding pages; active state highlighted | Pass | – |
| Mobile navigation | Click nav toggle on mobile widths (<768px) | Menu opens and closes; links accessible | Pass | Minor overlap with CTA on extremely small widths (≤320px) |
| Products page | Apply filters, search and pagination | Filter and search inputs submit (no back‑end logic yet); layout remains intact | Pass | Filters are currently static placeholders |
| Product detail page | View gallery and specs | Thumbnail click updates main image; specs and features sections display | Pass | – |
| Solutions page | View cards and navigate to individual solution | Solution detail pages load; benefits list displays | Pass | – |
| Projects and case studies | Open project details | Details load; list of solutions used and outcomes display | Pass | – |
| Learn page | View blog post list | Posts display with categories; categories filter buttons present (not functional) | Pass | – |
| Homeowners & Professionals pages | Read content and CTAs | Cards display; CTAs link to booking or contact forms | Pass | – |
| Book Demo form | Fill out and submit | Form collects information; submission not processed server‑side | Pass | Needs back‑end integration |
| Service areas | Navigate to city pages | Each city page displays tailored content and CTA | Pass | – |
| Contact form | Fill out and submit | Form fields accept input; no back‑end processing | Pass | Implementation required |
| Error pages | Navigate to non‑existent URLs | Custom 404 page displays with message and CTA | Pass | – |
| Admin login | Enter valid credentials | Redirect to dashboard; session created | Pass | – |
| Admin security | Attempt SQL injection in login | Invalid credentials; login fails | Pass | Parameterised queries prevent injection |
| Admin logout | Click logout link | Session destroyed; redirected to login page | Pass | – |

**Summary:** All public pages load without PHP notices or missing assets. Navigation and responsive design work across tested browsers. Forms are present but require back‑end handling. The admin login uses hashed passwords and prepared statements. Future QA should include automated tests and integration tests once CRUD functionality is implemented.