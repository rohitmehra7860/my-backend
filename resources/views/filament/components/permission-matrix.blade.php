<style>
    :root {
        --color-border-tertiary: #e5e7eb;
        --color-background-primary: #ffffff;
        --color-background-secondary: #f9fafb;
        --color-background-tertiary: #f3f4f6;
        --color-text-primary: #111827;
        --color-text-secondary: #6b7280;
        --color-border-secondary: #d1d5db;
    }

    .dark {
        --color-border-tertiary: #374151;
        --color-background-primary: #1f2937;
        --color-background-secondary: #111827;
        --color-background-tertiary: #0f172a;
        --color-text-primary: #f9fafb;
        --color-text-secondary: #9ca3af;
        --color-border-secondary: #4b5563;
    }

    .pm-wrap {
        border-radius: 12px;
        border: 0.5px solid var(--color-border-tertiary);
        overflow: hidden;
        background: var(--color-background-primary)
    }

    /* Header */
    .pm-header {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        padding: 14px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between
    }

    .pm-header-title {
        display: flex;
        align-items: center;
        gap: 8px;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.01em
    }

    .pm-header-title svg {
        width: 16px;
        height: 16px;
        opacity: 0.9
    }

    .pm-select-all {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        color: rgba(255, 255, 255, 0.9);
        font-size: 12px;
        font-weight: 500
    }

    /* Table */
    .pm-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed
    }

    .pm-table thead tr {
        background: var(--color-background-secondary);
        border-bottom: 0.5px solid var(--color-border-tertiary)
    }

    .pm-table th {
        padding: 10px 8px;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        text-align: center
    }

    .pm-table th:first-child {
        text-align: left;
        padding-left: 16px;
        width: 30%;
        color: var(--color-text-secondary)
    }

    .pm-th-all {
        color: var(--color-text-secondary) !important;
        width: 12%
    }

    .pm-th-view {
        color: #185FA5 !important;
        width: 14%
    }

    .pm-th-create {
        color: #3B6D11 !important;
        width: 14%
    }

    .pm-th-edit {
        color: #854F0B !important;
        width: 14%
    }

    .pm-th-delete {
        color: #A32D2D !important;
        width: 14%
    }

    .pm-th-icon {
        display: inline-flex;
        align-items: center;
        gap: 4px
    }

    /* Rows */
    .pm-row {
        border-bottom: 0.5px solid var(--color-border-tertiary);
        transition: background 0.15s
    }

    .pm-row:nth-child(even) {
        background: var(--color-background-secondary)
    }

    .pm-row:hover {
        background: rgba(99, 102, 241, 0.06) !important
    }

    .pm-row-active {
        background: rgba(99, 102, 241, 0.04) !important
    }

    .pm-row-active:hover {
        background: rgba(99, 102, 241, 0.09) !important
    }

    .pm-row td {
        padding: 10px 8px;
        text-align: center
    }

    .pm-row td:first-child {
        text-align: left;
        padding-left: 16px
    }

    /* Module label */
    .pm-module-label {
        display: flex;
        align-items: center;
        gap: 10px
    }

    .pm-sno {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 12px;
        font-weight: 600
    }

    .pm-sno-0 {
        background: #E6F1FB;
        color: #185FA5
    }

    .pm-sno-1 {
        background: #EEEDFE;
        color: #534AB7
    }

    .pm-sno-2 {
        background: #EAF3DE;
        color: #3B6D11
    }

    .pm-sno-3 {
        background: #FAEEDA;
        color: #854F0B
    }

    .pm-icon-dashboard {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 12px;
        font-weight: 600;
        background: #E1F5EE;
        color: #0F6E56
    }

    .pm-icon-activity {
        width: 28px;
        height: 28px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 12px;
        font-weight: 600;
        background: #FAEEDA;
        color: #BA7517
    }

    .pm-name {
        font-size: 13px;
        font-weight: 500;
        color: var(--color-text-primary);
        text-transform: capitalize
    }

    /* Custom checkboxes */
    .pm-cb-wrap {
        display: flex;
        align-items: center;
        justify-content: center
    }

    .pm-cb-wrap input[type=checkbox] {
        appearance: none;
        -webkit-appearance: none;
        width: 17px;
        height: 17px;
        border-radius: 5px;
        border: 1.5px solid var(--color-border-secondary);
        background: var(--color-background-primary);
        cursor: pointer;
        transition: all 0.15s;
        position: relative;
        flex-shrink: 0
    }

    .pm-cb-wrap input[type=checkbox]:disabled {
        opacity: 0.4;
        cursor: not-allowed
    }

    /* All checkbox */
    .pm-cb-all input[type=checkbox]:checked {
        background: #6366f1;
        border-color: #6366f1
    }

    .pm-cb-all input[type=checkbox]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 11px;
        font-weight: 700
    }

    /* View checkbox - blue */
    .pm-cb-view input[type=checkbox]:checked {
        background: #185FA5;
        border-color: #185FA5
    }

    .pm-cb-view input[type=checkbox]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 11px;
        font-weight: 700
    }

    /* Create checkbox - green */
    .pm-cb-create input[type=checkbox]:checked {
        background: #3B6D11;
        border-color: #3B6D11
    }

    .pm-cb-create input[type=checkbox]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 11px;
        font-weight: 700
    }

    /* Edit checkbox - amber */
    .pm-cb-edit input[type=checkbox]:checked {
        background: #854F0B;
        border-color: #854F0B
    }

    .pm-cb-edit input[type=checkbox]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 11px;
        font-weight: 700
    }

    /* Delete checkbox - red */
    .pm-cb-delete input[type=checkbox]:checked {
        background: #A32D2D;
        border-color: #A32D2D
    }

    .pm-cb-delete input[type=checkbox]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #fff;
        font-size: 11px;
        font-weight: 700
    }

    /* Section divider */
    .pm-section-divider td {
        padding: 6px 16px;
        font-size: 10px;
        font-weight: 600;
        color: var(--color-text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.06em;
        background: var(--color-background-tertiary);
        border-bottom: 0.5px solid var(--color-border-tertiary)
    }

    /* Dash */
    .pm-dash {
        color: var(--color-text-secondary);
        font-size: 13px
    }

    /* Footer */
    .pm-footer {
        background: var(--color-background-secondary);
        padding: 10px 16px;
        border-top: 0.5px solid var(--color-border-tertiary);
        display: flex;
        align-items: center;
        justify-content: space-between
    }

    .pm-count {
        font-size: 12px;
        color: var(--color-text-secondary)
    }

    .pm-count strong {
        color: var(--color-text-primary);
        font-weight: 600
    }

    .pm-active {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        color: #6366f1;
        font-weight: 500
    }

    /* Select all checkbox in header */
    .pm-select-all input[type=checkbox] {
        appearance: none;
        -webkit-appearance: none;
        width: 15px;
        height: 15px;
        border-radius: 4px;
        border: 1.5px solid rgba(255, 255, 255, 0.5);
        background: rgba(255, 255, 255, 0.15);
        cursor: pointer;
        transition: all 0.15s;
        position: relative;
        flex-shrink: 0
    }

    .pm-select-all input[type=checkbox]:checked {
        background: rgba(255, 255, 255, 0.9);
        border-color: rgba(255, 255, 255, 0.9)
    }

    .pm-select-all input[type=checkbox]:checked::after {
        content: '✓';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: #6366f1;
        font-size: 10px;
        font-weight: 700
    }

    /* Mobile */
    @media(max-width:600px) {

        .pm-th-create,
        .pm-th-edit,
        .pm-table td:nth-child(4),
        .pm-table td:nth-child(5) {
            display: none
        }

        .pm-table th:first-child {
            width: 40%
        }

        .pm-sno {
            width: 22px;
            height: 22px;
            font-size: 11px;
            border-radius: 6px
        }

        .pm-name {
            font-size: 12px
        }
    }
</style>

<div x-data="permissionMatrix(@js($permissions), @js($selected), @js($readonly ?? false))">
    <div class="pm-wrap">

        {{-- Header --}}
        <div class="pm-header">
            <div class="pm-header-title">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                </svg>
                Permission Matrix
            </div>
            <label class="pm-select-all" x-show="!isReadonly">
                <input type="checkbox" @change="toggleEverything($event.target.checked)"
                    :checked="checked.length === allPermissions.length && allPermissions.length > 0">
                Select all
            </label>
        </div>

        {{-- Table --}}
        <table class="pm-table">
            <thead>
                <tr>
                    <th>Module</th>
                    <th class="pm-th-all">
                        <span class="pm-th-icon">All</span>
                    </th>
                    <th class="pm-th-view">
                        <span class="pm-th-icon">👁 View</span>
                    </th>
                    <th class="pm-th-create">
                        <span class="pm-th-icon">✚ Create</span>
                    </th>
                    <th class="pm-th-edit">
                        <span class="pm-th-icon">✎ Edit</span>
                    </th>
                    <th class="pm-th-delete">
                        <span class="pm-th-icon">✕ Delete</span>
                    </th>
                </tr>
            </thead>
            <tbody>

                {{-- Main modules --}}
                <template x-for="(module, i) in modules" :key="module">
                    <tr class="pm-row" :class="checked.some(p => p.endsWith(' ' + module)) ? 'pm-row-active' : ''">
                        <td>
                            <div class="pm-module-label">
                                <div class="pm-sno" :class="'pm-sno-' + i">
                                    <span x-text="i + 1"></span>
                                </div>
                                <span class="pm-name" x-text="module"></span>
                            </div>
                        </td>
                        <td>
                            <div class="pm-cb-wrap pm-cb-all">
                                <input type="checkbox"
                                    :checked="['view', 'create', 'edit', 'delete'].every(a => checked.includes(a + ' ' + module))"
                                    @change="toggleAll(module, $event.target.checked)" :disabled="isReadonly">
                            </div>
                        </td>
                        <td>
                            <div class="pm-cb-wrap pm-cb-view">
                                <input type="checkbox" :value="'view ' + module" x-model="checked"
                                    @change="onView(module)" :disabled="isReadonly">
                            </div>
                        </td>
                        <td>
                            <div class="pm-cb-wrap pm-cb-create">
                                <input type="checkbox" :value="'create ' + module" x-model="checked"
                                    @change="onAction(module)" :disabled="isReadonly">
                            </div>
                        </td>
                        <td>
                            <div class="pm-cb-wrap pm-cb-edit">
                                <input type="checkbox" :value="'edit ' + module" x-model="checked"
                                    @change="onAction(module)" :disabled="isReadonly">
                            </div>
                        </td>
                        <td>
                            <div class="pm-cb-wrap pm-cb-delete">
                                <input type="checkbox" :value="'delete ' + module" x-model="checked"
                                    @change="onAction(module)" :disabled="isReadonly">
                            </div>
                        </td>
                    </tr>
                </template>

                {{-- Divider --}}
                <tr class="pm-section-divider">
                    <td colspan="6">Other</td>
                </tr>

                {{-- Dashboard --}}
                <tr class="pm-row" :class="checked.includes('view dashboard') ? 'pm-row-active' : ''">
                    <td>
                        <div class="pm-module-label">
                            <div class="pm-icon-dashboard">5</div>
                            <span class="pm-name">Dashboard</span>
                        </div>
                    </td>
                    <td>
                        <div class="pm-cb-wrap pm-cb-all">
                            <input type="checkbox" :checked="checked.includes('view dashboard')"
                                @change="$event.target.checked ? (!checked.includes('view dashboard') && checked.push('view dashboard')) : (checked = checked.filter(p => p !== 'view dashboard'))"
                                :disabled="isReadonly">
                        </div>
                    </td>
                    <td>
                        <div class="pm-cb-wrap pm-cb-view">
                            <input type="checkbox" value="view dashboard" x-model="checked" :disabled="isReadonly">
                        </div>
                    </td>
                    <td><span class="pm-dash">—</span></td>
                    <td><span class="pm-dash">—</span></td>
                    <td><span class="pm-dash">—</span></td>
                </tr>

                {{-- Activity Logs --}}
                <tr class="pm-row"
                    :class="checked.includes('view activity logs') || checked.includes('delete activity logs') ?
                        'pm-row-active' : ''">
                    <td>
                        <div class="pm-module-label">
                            <div class="pm-icon-activity">6</div>
                            <span class="pm-name">Activity logs</span>
                        </div>
                    </td>
                    <td>
                        <div class="pm-cb-wrap pm-cb-all">
                            <input type="checkbox"
                                :checked="checked.includes('view activity logs') && checked.includes('delete activity logs')"
                                @change="toggleActivityAll($event.target.checked)" :disabled="isReadonly">
                        </div>
                    </td>
                    <td>
                        <div class="pm-cb-wrap pm-cb-view">
                            <input type="checkbox" value="view activity logs" x-model="checked" :disabled="isReadonly">
                        </div>
                    </td>
                    <td><span class="pm-dash">—</span></td>
                    <td><span class="pm-dash">—</span></td>
                    <td>
                        <div class="pm-cb-wrap pm-cb-delete">
                            <input type="checkbox" value="delete activity logs" x-model="checked"
                                @change="onActivityDelete()" :disabled="isReadonly">
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>

        {{-- Footer --}}
        <div class="pm-footer">
            <span class="pm-count">
                <strong x-text="checked.length"></strong> permission(s) selected
            </span>
            <span class="pm-active" x-show="checked.length > 0">
                ✓ Active
            </span>
        </div>

    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('permissionMatrix', (permissions, selected, isReadonly) => ({
            modules: ['users', 'roles', 'blog', 'shop'],
            allPermissions: permissions,
            checked: selected || [],
            isReadonly: isReadonly,

            init() {
                if (this.$wire && !this.isReadonly) {
                    this.$wire.set('data.permissions', this.checked);
                }
                this.$watch('checked', (val) => {
                    if (this.$wire && !this.isReadonly) {
                        this.$wire.set('data.permissions', val);
                    }
                });
            },

            hasAll(module) {
                return ['view', 'create', 'edit', 'delete'].every(a => this.checked.includes(a +
                    ' ' + module));
            },

            toggleAll(module, val) {
                ['view', 'create', 'edit', 'delete'].forEach(a => {
                    const p = a + ' ' + module;
                    if (val && !this.checked.includes(p)) this.checked.push(p);
                    if (!val) this.checked = this.checked.filter(c => c !== p);
                });
            },

            toggleEverything(val) {
                this.checked = val ? [...this.allPermissions] : [];
            },

            toggleActivityAll(val) {
                ['view activity logs', 'delete activity logs'].forEach(p => {
                    if (val && !this.checked.includes(p)) this.checked.push(p);
                    if (!val) this.checked = this.checked.filter(c => c !== p);
                });
            },

            onView(module) {
                if (!this.checked.includes('view ' + module)) {
                    this.checked = this.checked.filter(p => !p.endsWith(' ' + module));
                }
            },

            onAction(module) {
                if (!this.checked.includes('view ' + module)) this.checked.push('view ' + module);
            },

            onActivityDelete() {
                if (this.checked.includes('delete activity logs') && !this.checked.includes(
                        'view activity logs')) {
                    this.checked.push('view activity logs');
                }
            },
        }));
    });
</script>
