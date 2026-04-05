<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\OcrUploadRequest;
use App\Http\Resources\v1\OcrUploadResource;
use App\Models\OcrUpload;
use App\Models\OcrUploads;

class OcrUploadController extends Controller
{
    /**
     * GET /ocr-uploads
     */
    public function index()
    {
        $uploads = OcrUploads::latest()->paginate(10);

        return OcrUploadResource::collection($uploads);
    }

    /**
     * POST /ocr-uploads
     */
    public function store(OcrUploadRequest $request)
    {
        $data = $request->validated();

        $upload = OcrUploads::create($data);

        return new OcrUploadResource($upload);
    }

    /**
     * GET /ocr-uploads/{id}
     */
    public function show(string $id)
    {
        $upload = OcrUploads::findOrFail($id);

        return new OcrUploadResource($upload);
    }

    /**
     * PUT/PATCH /ocr-uploads/{id}
     */
    public function update(OcrUploadRequest $request, string $id)
    {
        $upload = OcrUploads::findOrFail($id);

        $upload->update($request->validated());

        return new OcrUploadResource($upload);
    }

    /**
     * DELETE /ocr-uploads/{id}
     */
    public function destroy(string $id)
    {
        $upload = OcrUploads::findOrFail($id);

        $upload->delete();

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
