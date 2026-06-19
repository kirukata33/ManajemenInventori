<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="icon" type="image/png" href="{{ asset('logolaravel.png') }}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'InventManager') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            {{-- Left Panel - Branding --}}
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-slate-900">
                
                {{-- WebGL Smoke Animation Canvas --}}
                <canvas id="smoke-canvas" class="absolute inset-0 w-full h-full z-0 opacity-80 mix-blend-screen"></canvas>

                {{-- Grid pattern --}}
                <div class="absolute inset-0 opacity-[0.03] z-0" style="background-image: url('data:image/svg+xml,%3Csvg width=%2240%22 height=%2240%22 viewBox=%220 0 40 40%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M0 0h40v40H0V0zm1 1h38v38H1V1z%22 fill=%22%23fff%22 fill-opacity=%221%22/%3E%3C/svg%3E');"></div>

                {{-- Content --}}
                <div class="relative flex flex-col justify-center px-16 z-10 w-full">
                    <div class="flex items-center gap-3 mb-12">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30" style="background: var(--gradient-primary);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <span class="text-2xl font-extrabold text-white tracking-tight">Invent<span class="text-indigo-400">Manager</span></span>
                    </div>

                    <h2 class="text-4xl font-extrabold text-white leading-tight mb-4 tracking-tight">
                        Sistem Manajemen<br>Inventori <span class="text-indigo-400">Modern</span>
                    </h2>
                    <p class="text-lg text-slate-400 max-w-md leading-relaxed">
                        Kelola stok barang, catat transaksi masuk & keluar, dan pantau inventori Anda secara real-time.
                    </p>

                    <div class="flex items-center gap-6 mt-12">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center backdrop-blur-md">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <span class="text-sm text-slate-300 font-medium">Real-time</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center backdrop-blur-md">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <span class="text-sm text-slate-300 font-medium">Aman</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-amber-500/10 border border-amber-500/20 flex items-center justify-center backdrop-blur-md">
                                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <span class="text-sm text-slate-300 font-medium">Cepat</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Panel - Form --}}
            <div class="flex-1 flex flex-col justify-center items-center px-6 py-12 bg-white lg:bg-slate-50/50 relative z-20">
                {{-- Mobile Logo --}}
                <div class="lg:hidden flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: var(--gradient-primary);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <span class="text-xl font-extrabold text-slate-900 tracking-tight">Invent<span class="text-indigo-600">Manager</span></span>
                </div>

                <div class="w-full max-w-md">
                    <div class="bg-white rounded-2xl shadow-xl shadow-slate-200/50 border border-slate-100 p-8 animate-scale-in">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        {{-- WebGL Smoke Animation Script --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const fragmentShaderSource = `#version 300 es
                precision highp float;
                out vec4 O;
                uniform float time;
                uniform vec2 resolution;
                uniform vec3 u_color;

                #define FC gl_FragCoord.xy
                #define R resolution
                #define T (time+660.)

                float rnd(vec2 p){p=fract(p*vec2(12.9898,78.233));p+=dot(p,p+34.56);return fract(p.x*p.y);}
                float noise(vec2 p){vec2 i=floor(p),f=fract(p),u=f*f*(3.-2.*f);return mix(mix(rnd(i),rnd(i+vec2(1,0)),u.x),mix(rnd(i+vec2(0,1)),rnd(i+1.),u.x),u.y);}
                float fbm(vec2 p){float t=.0,a=1.;for(int i=0;i<5;i++){t+=a*noise(p);p*=mat2(1,-1.2,.2,1.2)*2.;a*=.5;}return t;}

                void main(){
                  vec2 uv=(FC-.5*R)/R.y;
                  vec3 col=vec3(1);
                  uv.x+=.25;
                  uv*=vec2(2,1);

                  float n=fbm(uv*.28-vec2(T*.01,0));
                  n=noise(uv*3.+n*2.);

                  col.r-=fbm(uv+vec2(0,T*.015)+n);
                  col.g-=fbm(uv*1.003+vec2(0,T*.015)+n+.003);
                  col.b-=fbm(uv*1.006+vec2(0,T*.015)+n+.006);

                  col=mix(col, u_color, dot(col,vec3(.21,.71,.07)));

                  col=mix(vec3(.08),col,min(time*.1,1.));
                  col=clamp(col,.08,1.);
                  O=vec4(col,1);
                }`;

                class Renderer {
                    constructor(canvas, fragmentSource) {
                        this.vertexSrc = "#version 300 es\nprecision highp float;\nin vec4 position;\nvoid main(){gl_Position=position;}";
                        this.vertices = [-1, 1, -1, -1, 1, 1, 1, -1];
                        
                        this.canvas = canvas;
                        this.gl = canvas.getContext("webgl2");
                        if (!this.gl) {
                            console.warn("WebGL2 not supported");
                            return;
                        }
                        
                        this.program = null;
                        this.vs = null;
                        this.fs = null;
                        this.buffer = null;
                        this.color = [0.5, 0.5, 0.5];
                        
                        this.setup(fragmentSource);
                        this.init();
                    }
                    
                    updateColor(newColor) {
                        this.color = newColor;
                    }

                    updateScale() {
                        const dpr = Math.max(1, window.devicePixelRatio);
                        const rect = this.canvas.parentElement.getBoundingClientRect();
                        this.canvas.width = rect.width * dpr;
                        this.canvas.height = rect.height * dpr;
                        this.gl.viewport(0, 0, this.canvas.width, this.canvas.height);
                    }

                    compile(shader, source) {
                        const gl = this.gl;
                        gl.shaderSource(shader, source);
                        gl.compileShader(shader);
                        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
                            console.error(`Shader compilation error: ${gl.getShaderInfoLog(shader)}`);
                        }
                    }

                    setup(fragmentSource) {
                        const gl = this.gl;
                        this.vs = gl.createShader(gl.VERTEX_SHADER);
                        this.fs = gl.createShader(gl.FRAGMENT_SHADER);
                        const program = gl.createProgram();
                        if (!this.vs || !this.fs || !program) return;
                        
                        this.compile(this.vs, this.vertexSrc);
                        this.compile(this.fs, fragmentSource);
                        
                        this.program = program;
                        gl.attachShader(this.program, this.vs);
                        gl.attachShader(this.program, this.fs);
                        gl.linkProgram(this.program);
                    }

                    init() {
                        const { gl, program } = this;
                        if (!program) return;
                        
                        this.buffer = gl.createBuffer();
                        gl.bindBuffer(gl.ARRAY_BUFFER, this.buffer);
                        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(this.vertices), gl.STATIC_DRAW);
                        
                        const position = gl.getAttribLocation(program, "position");
                        gl.enableVertexAttribArray(position);
                        gl.vertexAttribPointer(position, 2, gl.FLOAT, false, 0, 0);
                        
                        Object.assign(program, {
                            resolution: gl.getUniformLocation(program, "resolution"),
                            time: gl.getUniformLocation(program, "time"),
                            u_color: gl.getUniformLocation(program, "u_color"),
                        });
                    }

                    render(now = 0) {
                        const { gl, program, buffer, canvas } = this;
                        if (!program || !gl.isProgram(program)) return;
                        
                        gl.clearColor(0, 0, 0, 1);
                        gl.clear(gl.COLOR_BUFFER_BIT);
                        gl.useProgram(program);
                        gl.bindBuffer(gl.ARRAY_BUFFER, buffer);
                        
                        gl.uniform2f(program.resolution, canvas.width, canvas.height);
                        gl.uniform1f(program.time, now * 1e-3);
                        gl.uniform3fv(program.u_color, this.color);
                        
                        gl.drawArrays(gl.TRIANGLE_STRIP, 0, 4);
                    }
                }

                const hexToRgb = (hex) => {
                    const result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
                    return result ? [
                        parseInt(result[1], 16) / 255,
                        parseInt(result[2], 16) / 255,
                        parseInt(result[3], 16) / 255,
                    ] : null;
                };

                const canvas = document.getElementById('smoke-canvas');
                if (!canvas || !window.WebGL2RenderingContext) return;

                const renderer = new Renderer(canvas, fragmentShaderSource);
                if (!renderer.gl) return;
                
                // Set custom color (Indigo #6366f1)
                renderer.updateColor(hexToRgb("#6366f1"));

                const handleResize = () => renderer.updateScale();
                handleResize();
                window.addEventListener('resize', handleResize);

                let animationFrameId;
                const loop = (now) => {
                    renderer.render(now);
                    animationFrameId = requestAnimationFrame(loop);
                };
                loop(0);
            });
        </script>
    </body>
</html>
