<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'title'       => 'min:2',
                    'body'        => 'required|min:3',
                    'chapter_id' => 'numeric',
                    'type'=>'numeric',
                    'author'=>'numeric',
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            };
        }
    }

    public function messages()
    {
        return [
            'title.min' => '标题必须至少两个字符',
            'body.min' => '文章内容必须至少三个字符',
            'chapter_id.required'=>'章节不能为空',
            'chapter_id.numeric'=>'章节必须为数字'
        ];
    }
}
