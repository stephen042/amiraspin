<div>
    <div class="verify-page" x-data="{
        loading: false,
        progress: 0,
        runProgress() {
            this.loading = true;
            this.progress = 0;
            let interval = setInterval(() => {
                if (this.progress >= 100) {
                    clearInterval(interval);
                    this.loading = false;
                    $wire.verifyStep();
                } else { this.progress += 5; }
            }, 50);
        }
    }">
        <div class="verify-card">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <span style="color: #3b82f6; font-weight: 800; font-size: 12px;">STEP {{ $step }} OF 3</span>
                <span x-show="loading" style="font-size: 12px; color: #60a5fa;">Processing...</span>
            </div>

            <div class="progress-container">
                <div class="progress-bar" :style="'width: ' + progress + '%'"></div>
            </div>

            <div x-show="$wire.step === 1 && !loading">
                <h2>Tax Verification</h2>
                <input type="text" wire:model="tax_code" placeholder="********" class="input-field">
                <button @click="runProgress()" class="btn-verify" style="margin-top:20px">VERIFY TAX</button>
            </div>

            <div x-show="$wire.step === 2 && !loading">
                <h2>COT Verification</h2>
                <input type="text" wire:model="cot_code" placeholder="********" class="input-field">
                <button @click="runProgress()" class="btn-verify" style="margin-top:20px">VERIFY COT</button>
            </div>

            <div x-show="$wire.step === 3 && !loading">
                <h2>Token Finalization</h2>
                <input type="text" wire:model="token_code" placeholder="********" class="input-field">
                <button @click="runProgress()" class="btn-verify" style="margin-top:20px">COMPLETE</button>
            </div>

            @if ($step === 4)
                <div style="text-align: center;">
                    <div style="color: #10b981; font-size: 60px;">✓</div>
                    <h2>Approved!</h2>
                    <a href="/dashboard" class="btn-verify" style="display: block; text-decoration:none;">DASHBOARD</a>
                </div>
            @endif
        </div>
    </div>
</div>
