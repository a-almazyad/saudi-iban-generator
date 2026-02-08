# Security Guidance

## Immediate Response for an Exposed Laravel `APP_KEY`

1. **Rotate the key immediately**
   - Generate a new key and replace it in your environment (e.g., `APP_KEY=` in your hosting provider’s secret store).
   - Clear any cached config after updating the key to ensure the new value is used.

2. **Invalidate existing sessions and encrypted data**
   - Rotating `APP_KEY` invalidates encrypted values and sessions; plan for user sign-outs and re-encryption of any stored data.

3. **Remove the secret from Git history (if it was committed)**
   - Use `git filter-repo` (or BFG) to purge the secret from history.
   - Force-push the cleaned history and coordinate with collaborators to rebase.

4. **Audit exposure and notify if needed**
   - Check deployment logs, CI/CD logs, and artifact stores for lingering copies.
   - If this is a production system, follow your incident response plan.

5. **Prevent future leaks**
   - Keep secrets only in environment variables or secret managers.
   - Enable GitHub secret scanning and push protection.

## Repo Hygiene

- Ensure local secrets stay untracked (e.g., `.env` remains ignored).

