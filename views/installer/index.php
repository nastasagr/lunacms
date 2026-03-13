<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="/images/luna.svg" type="image/svg+xml">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    "primary": '#1B4BDE',
                    "primary-light": "#DEE6FC",
                    "primary-hover": '#193DB0'
                }
            }
        }
    }
    </script>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800">
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="mb-8 text-center">

            <div class="flex justify-center items-center">
                <img width="100px" src="images/luna.svg" />
            </div>
            <span class="inline-flex rounded-full mt-3 bg-[#E0EEFF] px-3 py-1 text-sm font-medium text-primary">
                CMS Installer
            </span>
            <h1 class="mt-4 text-3xl font-semibold text-slate-900 sm:text-4xl">
                <?php echo $title; ?>
            </h1>
            <p class="mx-auto mt-3 max-w-2xl text-sm leading-6 text-slate-600 sm:text-base">
                LunaCMS is a lightweight CMS built with PHP, designed for clarity, speed, and developer-friendly
                simplicity.
            </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1.4fr_0.8fr]">
            <section class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 sm:p-8">
                <h2 class="text-xl font-semibold text-slate-900">Website Details</h2>
                <p class="mt-2 text-sm text-slate-600">
                    Enter the main information for your CMS installation.
                </p>

                <form class="mt-8 grid gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-primary">Website name</label>
                        <input type="text" placeholder="My Website"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500" />
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-primary">Admin email</label>
                        <input type="email" placeholder="admin@example.com"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500" />
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-primary">Template</label>
                        <select
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500">
                            <option>Photographer</option>
                            <option>Greek</option>

                        </select>
                    </div>

                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-primary">Website URL</label>
                        <input type="text" placeholder="https://example.com"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500" />
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-primary">Admin username</label>
                        <input type="text" placeholder="admin"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500" />
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-primary">Password</label>
                        <input type="password" placeholder="••••••••"
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500" />
                    </div>

                    <div class="sm:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-primary">Maintenance Text</label>
                        <textarea rows="4" placeholder="This text shows when your website is in maintenance mode..."
                            class="w-full rounded-2xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-blue-500"></textarea>
                    </div>

                    <div
                        class="sm:col-span-2 flex flex-col gap-3 border-t border-slate-200 pt-6 sm:flex-row sm:justify-end">

                        <button type="submit"
                            class="rounded-2xl bg-primary px-5 py-3 text-sm font-semibold text-white transition hover:bg-primary-hover">
                            Install Luna
                        </button>
                    </div>
                </form>
            </section>

            <aside class="space-y-6">
                <div class="rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200">
                    <h3 class="text-lg font-semibold text-slate-900">Quick Summary</h3>
                    <div class="mt-5 space-y-4">
                        <div class="rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-200">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Environment</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">Production Ready</p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-200">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Database</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">MySQL / MariaDB</p>
                        </div>
                        <div class="rounded-2xl bg-slate-50 p-4 ring-1 ring-slate-200">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">Theme</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">Light Minimal UI</p>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl bg-primary-light p-6 ring-1 ring-blue-100">
                    <h3 class="text-lg font-semibold text-slate-900">Before you install</h3>
                    <ul class="mt-4 space-y-3 text-sm text-slate-600">
                        <li>• Check that your domain is connected.</li>
                        <li>• Make sure your database is ready.</li>
                        <li>• Use a secure admin password.</li>
                    </ul>
                </div>
            </aside>
        </div>
    </main>
</body>

</html>