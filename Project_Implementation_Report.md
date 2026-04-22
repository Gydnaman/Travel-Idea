# ICOM6034 Group Project Implementation Report

This document details how the Travel Ideas project fulfills each requirement specified in the `ICOM6034GroupProject 2026.pdf` guidelines. The system was built using the recommended technology stack: **Laravel + jQuery + MySQL**, integrated with modern frontend styling (Bootstrap 5 + Custom CSS) to ensure a premium user experience.

---

## 1. USER ACCOUNT CREATION

**Requirement:** Users must be able to log in to use features. Unauthenticated users must be prompted to sign in. Account creation requires Email address, password, and name. Welcome message upon login.

**Implementation:**

- We utilized Laravel’s built-in UI Authentication scaffolding (`php artisan ui bootstrap --auth`) as the foundation.
- The `RegisterController` and `User` model validate and enforce the requirement for `name`, `email`, and `password`.
- Middleware (`auth`) is applied to core routes (like creating ideas, posting comments) to automatically redirect unauthenticated users to the Login page.
- Upon successful login, the `DashboardController` redirects the user to the `dashboard.blade.php` view, which dynamically displays a personalized welcome message: "Welcome back, {{ Auth::user()->name }}!".

## 2. MANAGE (ADD/DELETE/MODIFY) TRAVEL IDEAS

**Requirement:** Add new travel ideas (title, destination, start date, end date, tags). Edit all information. Delete options.

**Implementation:**

- **Create:** Integrated within `TravelIdeaController@create` and `store`. Users fill out a beautifully designed form capturing Title, Destination, Schedule (Start Date, End Date), and Tags (comma-separated).
- **Edit/Update:** The `edit` and `update` methods fetch the specific travel idea. Security policies ensure only the owner (`Auth::id() == $travelIdea->user_id`) can authorize updates.
- **Delete:** The `destroy` routing uses Laravel's `@method('DELETE')`. In `show.blade.php`, an exclusive "Management Tools" panel appears only to the Idea's creator, offering one-click "Edit Trip" and "Delete Trip" actions.

## 3. SEARCHING OF TRAVEL IDEAS

**Requirement:** Search by destination or tags. Partial search support (e.g., "Hong" matches "Hong Kong"). Results display title, destination, date (MM/YYYY), number of comments, and a total count of matched records.

**Implementation:**

- A dual-search mechanism is provided: a standard keyword search on the navigation bar and an "Advanced Search" dedicated page (`travel-ideas.advanced-search`).
- **Partial Search:** Implemented using Eloquent ORM with `LIKE '%'.$keyword.'%'` clauses on both `destination` and `tags` columns.
- **Formatting & Counts:** In `TravelIdeaController`, queries attach comment counts using `->withCount('comments')`. Dates are parsed by Carbon on the frontend as `MM/YYYY` (`\Carbon\Carbon::parse($idea->start_date)->format('m/Y')`). The total match count is rendered prominently at the top of the search results blade `$ideas->total()`.

## 4. COMMENT ON TRAVEL IDEA

**Requirement:** Comment on own/others' ideas. AJAX implementation (like Facebook). Escaped and max 255 chars length. Receive real-time new comment updates. Reverse-chronological order.

**Implementation:**

- **AJAX Submissions:** Comments and threaded replies are completely form-submission-free. jQuery intercepts the `#comment-form` submission and posts to `CommentsController@store` asynchronously.
- **Security & Validation:** `htmlspecialchars` extraction ensures XSS protection. The Laravel backend explicitly enforces `$request->validate(['content' => 'required|string|max:255'])`.
- **Real-Time Updates (Polling):** Implemented an industry-standard short polling technique in JS (`setInterval(..., 5000)`). A script periodically calls the `comments.latest` route, passing the `lastCommentId`. Any new comments posted are dynamically appended cleanly into the DOM (`slideDown`) without refreshing the page.
- **Reverse Chronology:** Handled gracefully via the `->latest()` Eloquent scope when querying `$topComments`. A full interactive Upvote/Downvote (Like/Dislike) mechanics engine was also seamlessly integrated via AJAX APIs.

## 5. DATA VALIDATIONS

**Requirement:** Required for user account management and travel idea creation.

**Implementation:**

- Data consistency is rigidly enforced through Laravel Validation rules across controllers:
  - Account Creation: `name`, `email` (unique, standard format), `password` (min 8 chars, confirmation).
  - Travel Ideas: Validating logical boundaries, requiring that the `end_date` must be strictly explicitly *after or equal* to `start_date` (`'end_date' => 'required|date|after_or_equal:start_date'`), alongside strict length and datatype checks for `title` and `destination`.

## 6. WEB API MASHUPS

**Requirement:** Minimum of two modules using Web APIs related to traveling, utilizing keywords derived from the app.

**Implementation:**
We architected a centralized `ApiService` (`app/Services/ApiService.php`) to handle remote integrations cleanly.

1. **Aviation Weather Center API (AWC) - METAR Mashup:**
   - **Trigger:** The travel idea's `destination` keyword.
   - **Process:** First, the OpenMeteo Geocoding API converts the destination string into dynamic `latitude` and `longitude` coordinates.
   - **Mashup Execution:** The coordinates map out a geo-bounding box (`bbox`), which is sent to the official US Government Aviation Weather API (`https://aviationweather.gov/api/data/metar?bbox=...`). The system extracts the live atmospheric condition report of the nearest meteorological station, displaying real-time Temperature, Flight Category (VFR/IFR), Wind Speed, and Visibility natively embedded within the Trip detail UI (`show.blade.php`).

2. **Makcorps Hotel API:**
   - **Trigger:** The `destination` keyword.
   - **Execution:** Users view Hotel suggestions dynamically generated by querying the RestCountries and Makcorps OTA endpoints. The system parses responses asynchronously and generates a beautiful, contextual "Recommended Hotels" sidebar/panel for users, rendering live properties, ratings, pricing metrics, and redirection booking links natively inside our platform framework (`hotels.blade.php`).
